package main

import (
	"crypto/rsa"
	"fmt"
	"os"
	"strings"

	"github.com/golang-jwt/jwt/v5"
)

const (
	envIrmaServerURL    = "IRMA_SERVER_URL"
	envAPIToken         = "API_TOKEN"
	envBaseURL          = "BASE_URL"
	envServerPublicKey  = "IRMA_SERVER_PUBLICKEY"
	envIrmatubeCred     = "IRMATUBE_CREDENTIAL"
	envIrmatubeNextURL  = "IRMATUBE_NEXT_SESSION_URL"
	defaultIrmaServer   = "http://localhost:8088"
	defaultBaseURL      = "https://privacybydesign.foundation"
	defaultPublicKey    = "/mnt/config/is-pubkey.pem"
	defaultIrmatubeCred = "pbdf.pbdf.irmatube"
	nextSessionPath     = "/get_session_request.php"
)

type config struct {
	irmaServerURL      string
	apiToken           string
	baseURL            string
	irmatubeCredential string
	irmatubeNextURL    string
	serverKey          *rsa.PublicKey
}

func loadConfig(getenv func(string) string) (config, error) {
	baseURL := strings.TrimRight(envOr(getenv, envBaseURL, defaultBaseURL), "/")

	keyPath := envOr(getenv, envServerPublicKey, defaultPublicKey)
	serverKey, err := readPublicKey(keyPath)
	if err != nil {
		return config{}, fmt.Errorf("%s: %w", envServerPublicKey, err)
	}

	return config{
		irmaServerURL:      strings.TrimRight(envOr(getenv, envIrmaServerURL, defaultIrmaServer), "/"),
		apiToken:           getenv(envAPIToken),
		baseURL:            baseURL,
		irmatubeCredential: envOr(getenv, envIrmatubeCred, defaultIrmatubeCred),
		irmatubeNextURL:    envOr(getenv, envIrmatubeNextURL, baseURL+nextSessionPath),
		serverKey:          serverKey,
	}, nil
}

func envOr(getenv func(string) string, name, fallback string) string {
	if value := getenv(name); value != "" {
		return value
	}

	return fallback
}

func readPublicKey(path string) (*rsa.PublicKey, error) {
	pem, err := os.ReadFile(path)
	if err != nil {
		return nil, err
	}

	key, err := jwt.ParseRSAPublicKeyFromPEM(pem)
	if err != nil {
		return nil, fmt.Errorf("parse %s: %w", path, err)
	}

	return key, nil
}
