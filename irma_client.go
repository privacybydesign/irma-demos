package main

import (
	"bytes"
	"context"
	"fmt"
	"io"
	"net/http"
	"time"
)

const (
	irmaClientTimeout = 15 * time.Second
	maxIrmaResponse   = 1 << 20
	sessionPath       = "/session"

	headerAuthorization = "Authorization"
)

// irmaClient talks to the requestor API of the IRMA server.
type irmaClient struct {
	baseURL string
	token   string
	http    *http.Client
}

func newIrmaClient(cfg config) *irmaClient {
	return &irmaClient{
		baseURL: cfg.irmaServerURL,
		token:   cfg.apiToken,
		http:    &http.Client{Timeout: irmaClientTimeout},
	}
}

// startSession posts a session request and returns the server's response.
func (c *irmaClient) startSession(ctx context.Context, request []byte) ([]byte, error) {
	req, err := http.NewRequestWithContext(ctx, http.MethodPost, c.baseURL+sessionPath, bytes.NewReader(request))
	if err != nil {
		return nil, err
	}

	req.Header.Set(headerContentType, contentTypeJSON)
	if c.token != "" {
		req.Header.Set(headerAuthorization, c.token)
	}

	resp, err := c.http.Do(req)
	if err != nil {
		return nil, err
	}
	defer func() { _ = resp.Body.Close() }()

	if resp.StatusCode < http.StatusOK || resp.StatusCode >= http.StatusMultipleChoices {
		return nil, fmt.Errorf("IRMA server answered %s", resp.Status)
	}

	body, err := io.ReadAll(io.LimitReader(resp.Body, maxIrmaResponse))
	if err != nil {
		return nil, err
	}
	if len(body) == 0 {
		return nil, fmt.Errorf("IRMA server sent an empty response")
	}

	return body, nil
}
