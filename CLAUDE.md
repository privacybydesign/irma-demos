# irma-demos — repo notes

Go server for the Yivi demo pages and two endpoints for the IRMA server. It
replaced a PHP site; the `.php` URLs stay on purpose.

## Build & test

- `go vet ./... && go test ./...`. Go version is set in `go.mod`.
- `assets/yivi.js` is a build artifact (`./build_artifacts.sh`, or the
  Dockerfile). It is not in git and no test needs it; `assets/.gitkeep` keeps
  the `//go:embed all:assets` in `server.go` compiling without it.
- Tests use `httptest` with a fake IRMA server and a key pair made per test.

## Gotchas

- Only what `server.go` and `render.go` embed can be served. Add an embed
  pattern only for files that are meant to be public; `TestOnlyPublicRepoFilesAreServed`
  walks the repository and fails on anything else that answers 200.
- Callback JWTs are always verified (`callback.go`): RS256 only, key from
  `IRMA_SERVER_PUBLICKEY`, `exp` required. There is no switch to turn it off.
- Session requests in `session_requests.go` are structs, not maps, because the
  JSON in the "For developers" section must keep the key order of the original
  PHP arrays. `testdata/developer/*.json` is that output byte for byte, and
  `testdata/start/*.json` is what is posted to the IRMA server.
- Strings of type `template.HTML` are trusted markup of our own. Request data
  (query, path) must only reach templates as plain strings.
- Demo texts and the typed struct per demo live in `demo_<name>.go`; the
  markup that goes with them in `demos/<slug>/demo.html`.
