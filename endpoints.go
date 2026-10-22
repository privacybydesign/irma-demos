package main

import (
	"encoding/json"
	"errors"
	"io"
	"log/slog"
	"net/http"
	"strings"
	"time"
)

const (
	startSessionPath  = "/start_session.php"
	headerAllowOrigin = "Access-Control-Allow-Origin"
	headerContentType = "Content-Type"
	contentTypeJSON   = "application/json"
	maxCallbackBody   = 1 << 20
	queryType         = "type"
	msgInvalidRequest = "Invalid request"
	msgServerError    = "Internal server error"
)

// startSessionHandler serves start_session.php: it starts the session of a
// demo and passes the IRMA server's answer on to the browser.
func startSessionHandler(cfg config, sessions *sessionStarter) http.HandlerFunc {
	return func(w http.ResponseWriter, r *http.Request) {
		w.Header().Set(headerAllowOrigin, cfg.baseURL)

		query := r.URL.Query()
		if !query.Has(queryType) || !query.Has(queryLang) {
			http.Error(w, msgInvalidRequest, http.StatusBadRequest)
			return
		}

		response, err := sessions.start(r.Context(), query.Get(queryType), parseLang(query.Get(queryLang)))
		if errors.Is(err, errUnknownRequest) {
			http.Error(w, msgInvalidRequest, http.StatusBadRequest)
			return
		}
		if err != nil {
			slog.Error("starting session failed", "type", query.Get(queryType), "error", err)
			http.Error(w, msgServerError, http.StatusInternalServerError)
			return
		}

		w.Header().Set(headerContentType, contentTypeJSON)
		_, _ = w.Write(response)
	}
}

// nextSessionHandler serves get_session_request.php: the IRMA server calls it
// with a signed JWT to get the request for the second session of a chain.
func nextSessionHandler(cfg config) http.HandlerFunc {
	verifier := callbackVerifier{key: cfg.serverKey}

	return func(w http.ResponseWriter, r *http.Request) {
		w.Header().Set(headerAllowOrigin, cfg.baseURL)

		body, err := io.ReadAll(http.MaxBytesReader(w, r.Body, maxCallbackBody))
		if err != nil {
			http.Error(w, msgInvalidRequest, http.StatusBadRequest)
			return
		}

		claims, err := verifier.verify(strings.TrimSpace(string(body)))
		if err != nil {
			slog.Warn("rejected callback", "error", err)
			http.Error(w, http.StatusText(http.StatusForbidden), http.StatusForbidden)
			return
		}

		next, err := nextRequest(cfg, claims, r.URL.Query(), time.Now().UTC())
		if err != nil {
			http.Error(w, msgInvalidRequest, http.StatusBadRequest)
			return
		}

		writeJSON(w, next)
	}
}

func writeJSON(w http.ResponseWriter, value any) {
	w.Header().Set(headerContentType, contentTypeJSON)

	if err := json.NewEncoder(w).Encode(value); err != nil {
		slog.Error("writing response failed", "error", err)
	}
}
