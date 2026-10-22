package main

import (
	"bytes"
	"context"
	"encoding/json"
	"errors"
	"strings"
	"time"
)

const developerIndent = "    "

var errUnknownRequest = errors.New("unknown session request")

// sessionStarter starts the sessions of the demos on the IRMA server.
type sessionStarter struct {
	cfg  config
	irma *irmaClient
	now  func() time.Time
}

func newSessionStarter(cfg config) *sessionStarter {
	return &sessionStarter{cfg: cfg, irma: newIrmaClient(cfg), now: time.Now}
}

// start sends the request with the given id to the IRMA server and returns
// the server's response.
func (s *sessionStarter) start(ctx context.Context, id string, language lang) ([]byte, error) {
	request, ok := newRequests(s.cfg, s.now())[id]
	if !ok {
		return nil, errUnknownRequest
	}

	if perLang, ok := request.(langRequest); ok {
		request = perLang.forLang(language)
	}

	body, err := json.Marshal(request)
	if err != nil {
		return nil, err
	}

	return s.irma.startSession(ctx, body)
}

// developerRequest returns the request of a demo as shown in the "For
// developers" section. Demos that start no session on this server have none.
func (s *sessionStarter) developerRequest(slug string) (string, bool) {
	request, ok := newRequests(s.cfg, s.now())[slug]
	if !ok {
		return "", false
	}

	var out bytes.Buffer

	encoder := json.NewEncoder(&out)
	encoder.SetEscapeHTML(false)
	encoder.SetIndent("", developerIndent)

	if err := encoder.Encode(request); err != nil {
		return "", false
	}

	return strings.TrimSuffix(out.String(), "\n"), true
}
