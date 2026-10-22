FROM node:20 AS assets
WORKDIR /app

COPY package.json yarn.lock build_artifacts.sh ./
RUN yarn install --frozen-lockfile
RUN ./build_artifacts.sh

# -----------------------------------------------------

FROM golang:1.26.10 AS build
WORKDIR /app

COPY go.mod go.sum ./
RUN go mod download

COPY . .
COPY --from=assets /app/assets/yivi.js assets/yivi.js

# No cgo: the distroless/static runtime has no libc.
RUN CGO_ENABLED=0 go build -o /server .

# -----------------------------------------------------

FROM gcr.io/distroless/static-debian12:nonroot AS runtime

COPY --from=build /server /server

# Declared explicitly to satisfy static scanners; the :nonroot tag already
# defaults to this same user (UID 65532).
USER nonroot:nonroot

EXPOSE 8080
ENTRYPOINT [ "/server" ]
