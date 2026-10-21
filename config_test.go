package main

import (
	"os"
	"path/filepath"
	"strings"
	"testing"
)

func envFrom(values map[string]string) func(string) string {
	return func(name string) string { return values[name] }
}

func TestLoadConfigDefaults(t *testing.T) {
	keyPath := writePublicKey(t, &newTestKey(t).PublicKey)

	cfg, err := loadConfig(envFrom(map[string]string{envServerPublicKey: keyPath}))
	if err != nil {
		t.Fatal(err)
	}

	if cfg.irmaServerURL != "http://localhost:8088" {
		t.Errorf("irmaServerURL = %q", cfg.irmaServerURL)
	}
	if cfg.baseURL != "https://privacybydesign.foundation" {
		t.Errorf("baseURL = %q", cfg.baseURL)
	}
	if cfg.irmatubeCredential != "pbdf.pbdf.irmatube" {
		t.Errorf("irmatubeCredential = %q", cfg.irmatubeCredential)
	}
	if want := "https://privacybydesign.foundation/get_session_request.php"; cfg.irmatubeNextURL != want {
		t.Errorf("irmatubeNextURL = %q, want %q", cfg.irmatubeNextURL, want)
	}
	if cfg.serverKey == nil {
		t.Error("serverKey was not loaded")
	}
}

func TestLoadConfigOverrides(t *testing.T) {
	keyPath := writePublicKey(t, &newTestKey(t).PublicKey)

	cfg, err := loadConfig(envFrom(map[string]string{
		envIrmaServerURL:   "http://irma:8088/",
		envAPIToken:        "secret",
		envBaseURL:         "https://demos.example/",
		envServerPublicKey: keyPath,
		envIrmatubeCred:    "irma-demo.IRMATube.member",
		envIrmatubeNextURL: "https://tube.example/next",
	}))
	if err != nil {
		t.Fatal(err)
	}

	if cfg.irmaServerURL != "http://irma:8088" || cfg.baseURL != "https://demos.example" {
		t.Errorf("trailing slashes were kept: %q, %q", cfg.irmaServerURL, cfg.baseURL)
	}
	if cfg.apiToken != "secret" || cfg.irmatubeCredential != "irma-demo.IRMATube.member" {
		t.Errorf("overrides were ignored: %+v", cfg)
	}
	if cfg.irmatubeNextURL != "https://tube.example/next" {
		t.Errorf("irmatubeNextURL = %q", cfg.irmatubeNextURL)
	}
}

func TestConfigNeedsPublicKey(t *testing.T) {
	dir := t.TempDir()
	garbage := filepath.Join(dir, "garbage.pem")
	if err := os.WriteFile(garbage, []byte("not a key"), 0o600); err != nil {
		t.Fatal(err)
	}

	tests := map[string]string{
		"missing file": filepath.Join(dir, "missing.pem"),
		"invalid PEM":  garbage,
	}
	for name, path := range tests {
		t.Run(name, func(t *testing.T) {
			_, err := loadConfig(envFrom(map[string]string{envServerPublicKey: path}))
			if err == nil || !strings.Contains(err.Error(), envServerPublicKey) {
				t.Errorf("err = %v, want an error naming %s", err, envServerPublicKey)
			}
		})
	}
}
