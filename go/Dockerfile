# syntax=docker/dockerfile:1

## Build
FROM golang:alpine AS build
ENV CGO_ENABLED 0
ENV GOOS linux
RUN unset GOPATH
WORKDIR /go
COPY /go/go.mod ./
COPY /go/go.sum ./
RUN go mod download
COPY /go/ .
RUN go build -o /go .

## Deploy
FROM alpine
RUN apk add --no-cache ca-certificates && update-ca-certificates
WORKDIR /go
COPY --from=build /go /go
EXPOSE ${GO_PORT}
ENTRYPOINT ["/go"]
