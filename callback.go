package main

import (
	"crypto/rsa"

	"github.com/golang-jwt/jwt/v5"
)

// callbackClaims are the claims of the JWT with which the IRMA server calls
// the next-session URL of a chained session.
type callbackClaims struct {
	jwt.RegisteredClaims
	Disclosed [][]disclosedAttribute `json:"disclosed"`
}

type disclosedAttribute struct {
	RawValue string `json:"rawvalue"`
}

// firstDisclosed returns the raw value of the first disclosed attribute.
func (c callbackClaims) firstDisclosed() string {
	if len(c.Disclosed) == 0 || len(c.Disclosed[0]) == 0 {
		return ""
	}

	return c.Disclosed[0][0].RawValue
}

// callbackVerifier checks the signature of IRMA server callbacks against the
// configured public key. The algorithm and the key never come from the token.
type callbackVerifier struct {
	key *rsa.PublicKey
}

func (v callbackVerifier) verify(token string) (callbackClaims, error) {
	var claims callbackClaims

	_, err := jwt.ParseWithClaims(token, &claims,
		func(*jwt.Token) (any, error) { return v.key, nil },
		jwt.WithValidMethods([]string{jwt.SigningMethodRS256.Alg()}),
		jwt.WithExpirationRequired(),
		jwt.WithIssuedAt(),
	)

	return claims, err
}
