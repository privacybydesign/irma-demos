package main

import (
	"errors"
	"fmt"
	"math/rand/v2"
	"net/url"
	"strings"
	"time"
)

const (
	membershipMonths      = 6
	fallbackFullName      = "John Doe"
	memberType            = "premium"
	memberIDLength        = 11
	petitionSignatureType = "petition-signature"
)

var errNoCity = errors.New("callback disclosed no city")

type issuanceRequest struct {
	Context     string       `json:"@context"`
	Credentials []credential `json:"credentials"`
}

type credential struct {
	Credential string           `json:"credential"`
	Validity   int64            `json:"validity"`
	Attributes memberAttributes `json:"attributes"`
}

type memberAttributes struct {
	FullName string `json:"fullname"`
	Type     string `json:"type"`
	ID       string `json:"id"`
}

// nextRequest builds the request for the second session of a chain from the
// verified callback of the first. The query of the callback URL says which
// chain it is: the petition, or else the YiviTube membership.
func nextRequest(cfg config, claims callbackClaims, query url.Values, now time.Time) (any, error) {
	if query.Get(queryType) != petitionSignatureType {
		return membershipRequest(cfg, claims.firstDisclosed(), now), nil
	}

	city := claims.firstDisclosed()
	if city == "" {
		return nil, errNoCity
	}

	return petitionSignatureRequest(city, parseLang(query.Get(queryLang))), nil
}

// membershipRequest issues the YiviTube membership card for the second
// session of the chained demo.
func membershipRequest(cfg config, fullName string, now time.Time) issuanceRequest {
	if fullName == "" {
		fullName = fallbackFullName
	}

	return issuanceRequest{
		Context: contextIssuance,
		Credentials: []credential{{
			Credential: cfg.irmatubeCredential,
			Validity:   now.AddDate(0, membershipMonths, 0).Unix(),
			Attributes: memberAttributes{FullName: fullName, Type: memberType, ID: randomMemberID()},
		}},
	}
}

// randomMemberID returns a number of memberIDLength digits that does not
// start with a zero.
func randomMemberID() string {
	var id strings.Builder

	id.WriteByte(byte('1' + rand.IntN(9)))
	for id.Len() < memberIDLength {
		id.WriteByte(byte('0' + rand.IntN(10)))
	}

	return id.String()
}

// petitionSignatureRequest asks the visitor to sign the petition of their city.
func petitionSignatureRequest(city string, language lang) signatureRequest[string, string] {
	message := localized[string]{
		EN: fmt.Sprintf("I sign this petition to turn the Main Square in %s into a park", city),
		NL: fmt.Sprintf("Ik onderteken deze petitie om het Hoofdplein in %s in een park te veranderen", city),
	}

	return signatureRequest[string, string]{
		Context: contextSignature,
		Message: message.in(language),
		Disclose: [][][]string{{{
			"pbdf.gemeente.personalData.initials",
			"pbdf.gemeente.personalData.familyname",
		}}},
	}
}
