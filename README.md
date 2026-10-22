## IRMA demo pages

This project is the combination of all demos hosted on https://privacybydesign.foundation/demo/.

It is a Go server (`net/http`, `html/template`, `embed`) that serves the demo pages and two endpoints for the IRMA server. The pages are available in English and Dutch.

## URLs

| URL | What it is |
| --- | --- |
| `/` | Home page |
| `/demos/<slug>/` | Description page of a demo, with the demo embedded |
| `/demos/<slug>/demo.php` | The demo by itself |
| `/start_session.php?type=<slug>&lang=<en\|nl>` | Starts the session of a demo on the IRMA server |
| `/get_session_request.php` | Next-session callback of the IRMA server, for the chained and petition demos |

Pages take `?lang=en` or `?lang=nl`; English is the default. Unknown URLs give a 404 page. The `.php` names are kept so that existing links and the IRMA server configuration keep working.

## Configuration

| Environment variable | Default | |
| --- | --- | --- |
| `IRMA_SERVER_URL` | `http://localhost:8088` | IRMA server that sessions are started on |
| `API_TOKEN` | | Sent as the `Authorization` header to the IRMA server |
| `BASE_URL` | `https://privacybydesign.foundation` | Public URL of this site: the allowed CORS origin and the base of the callback URL of the petition demo |
| `IRMA_SERVER_PUBLICKEY` | `/mnt/config/is-pubkey.pem` | PEM public key of the IRMA server. The server does not start without it |
| `IRMATUBE_CREDENTIAL` | `pbdf.pbdf.irmatube` | Credential that the chained demo issues |
| `IRMATUBE_NEXT_SESSION_URL` | `<BASE_URL>/get_session_request.php` | Callback URL of the chained demo |

The callback JWT is always verified: RS256 only, against `IRMA_SERVER_PUBLICKEY`, with `exp` required.

The server listens on port 8080. `/` returns 200, so it can be used for liveness and startup probes.

## Run locally

You need Go (see `go.mod`) and an [IRMA server](https://github.com/privacybydesign/irmago) that signs its callbacks with the private key that belongs to `IRMA_SERVER_PUBLICKEY`.

* Run `yarn install --frozen-lockfile && ./build_artifacts.sh` to copy `yivi.js` into `assets/`.
* Run `IRMA_SERVER_PUBLICKEY=/path/to/public.pem go run .`

Alternatively, run `docker compose up`. This builds the image, starts an IRMA server and generates a key pair for them in a volume. The petition demo needs the IRMA server to reach `BASE_URL`, which it cannot do with the `localhost` address in `docker-compose.yml`.

## Tests

Run `go vet ./... && go test ./...`. The tests use a fake IRMA server and do not need `assets/yivi.js`. `Dockerfile.test` runs them in a container.

## Adding a demo

Example when adding a demo called `new-demo`:

* Make a directory `demos/new-demo` with:
    * `script.js`, the demo's own JavaScript. Start the session with `start_session_inline(slug, lang, verifier)` from `start_session.js`. `slug`, `lang` and `header_text` are set by the page.
    * `demo.html`, a template `body` with the markup of the demo's result, as in the other demos.
* Add `demo_newdemo.go`, a copy of an existing `demo_*.go`: a struct with the texts that `demo.html` uses, and a `demo` with the description page, the frame and the texts in both languages. The slug and the name in the navigation go there too.
* Add the demo to the `demos` list in `demos.go`, in the order of the navigation.
* Add the session request under the slug in `session_requests.go`, and a golden file for it in `testdata/developer/` and in `testdata/start/` (the tests tell you which).

Text with markup of our own (links, `<strong>`) has the type `template.HTML`. Everything else is escaped. Never use `template.HTML` for anything that comes from a request.

Only `resources/`, `start_session.js`, `assets/yivi.js` and `demos/*/script.js` are embedded and served. Other files in the repository are not reachable, and a test checks that.

## Image

`Dockerfile` builds `ghcr.io/privacybydesign/irma-demos`: it copies `yivi.js` out of the npm package, compiles a static binary and runs it on `gcr.io/distroless/static-debian12:nonroot`.
