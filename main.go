package main

import (
	"context"
	"errors"
	"log/slog"
	"net"
	"net/http"
	"os"
	"os/signal"
	"syscall"
	"time"
)

const (
	listenAddr        = ":8080"
	readHeaderTimeout = 10 * time.Second
	readTimeout       = 30 * time.Second
	idleTimeout       = 120 * time.Second
	shutdownTimeout   = 10 * time.Second
)

func main() {
	cfg, err := loadConfig(os.Getenv)
	if err != nil {
		slog.Error("invalid configuration", "error", err)
		os.Exit(1)
	}

	server := &http.Server{
		Handler:           newHandler(cfg),
		ReadHeaderTimeout: readHeaderTimeout,
		ReadTimeout:       readTimeout,
		IdleTimeout:       idleTimeout,
	}

	listener, err := net.Listen("tcp", listenAddr)
	if err != nil {
		slog.Error("cannot listen", "error", err)
		os.Exit(1)
	}

	stop, cancel := signal.NotifyContext(context.Background(), os.Interrupt, syscall.SIGTERM)
	defer cancel()

	slog.Info("listening", "addr", listenAddr)

	if err := serve(stop, server, listener); err != nil {
		slog.Error("server stopped", "error", err)
		os.Exit(1)
	}
}

// serve runs server on listener until stop is done, then waits for
// in-flight requests to finish.
func serve(stop context.Context, server *http.Server, listener net.Listener) error {
	shutdownDone := make(chan struct{})

	go func() {
		defer close(shutdownDone)

		<-stop.Done()

		ctx, cancelShutdown := context.WithTimeout(context.Background(), shutdownTimeout)
		defer cancelShutdown()

		if err := server.Shutdown(ctx); err != nil {
			slog.Error("shutdown failed", "error", err)
		}
	}()

	if err := server.Serve(listener); !errors.Is(err, http.ErrServerClosed) {
		return err
	}

	// Shutdown makes Serve return at once; wait for the drain.
	<-shutdownDone

	return nil
}
