package main

import (
	"context"
	"io"
	"net"
	"net/http"
	"testing"
	"time"
)

const shutdownGrace = 200 * time.Millisecond

func TestServeDrainsRequests(t *testing.T) {
	started := make(chan struct{})
	release := make(chan struct{})

	handler := http.HandlerFunc(func(w http.ResponseWriter, _ *http.Request) {
		close(started)
		<-release

		_, _ = io.WriteString(w, "done")
	})

	listener, err := net.Listen("tcp", "127.0.0.1:0")
	if err != nil {
		t.Fatal(err)
	}

	stop, cancel := context.WithCancel(context.Background())
	defer cancel()

	served := make(chan error, 1)

	go func() {
		served <- serve(stop, &http.Server{Handler: handler}, listener)
	}()

	body := make(chan string, 1)

	go func() {
		resp, err := http.Get("http://" + listener.Addr().String())
		if err != nil {
			body <- err.Error()

			return
		}
		defer resp.Body.Close()

		b, _ := io.ReadAll(resp.Body)
		body <- string(b)
	}()

	<-started
	cancel()

	select {
	case err := <-served:
		t.Fatalf("serve returned with a request in flight: %v", err)
	case <-time.After(shutdownGrace):
	}

	close(release)

	if got := <-body; got != "done" {
		t.Errorf("response = %q, want %q", got, "done")
	}

	if err := <-served; err != nil {
		t.Errorf("serve = %v, want nil", err)
	}
}
