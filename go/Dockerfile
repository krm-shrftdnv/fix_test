# syntax=docker/dockerfile:1

## Build
FROM golang:1.16-buster AS build

WORKDIR ./go

COPY ./go/go.mod ./
COPY ./go/go.sum ./
RUN go mod download

COPY ./go/ ./

RUN go build -o /fix_test

## Deploy
FROM gcr.io/distroless/base-debian10

WORKDIR /

COPY --from=build /fix_test /fix_test

EXPOSE 8080

#USER nonroot:nonroot

ENTRYPOINT ["/fix_test"]