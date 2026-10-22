package main

import (
	"fmt"
	"time"
)

const (
	contextDisclosure = "https://irma.app/ld/request/disclosure/v2"
	contextSignature  = "https://irma.app/ld/request/signature/v2"
	contextIssuance   = "https://irma.app/ld/request/issuance/v2"

	// Layout of PHP's date('d / m / Y').
	signatureDateLayout = "02 / 01 / 2006"
)

// The request types are structs, not maps, so that the JSON in the "For
// developers" section keeps the key order of the original PHP arrays.

type disclosureRequest struct {
	Context  string                       `json:"@context"`
	Disclose [][][]string                 `json:"disclose"`
	Labels   map[string]localized[string] `json:"labels,omitempty"`
}

type signatureRequest[M, A any] struct {
	Context  string  `json:"@context"`
	Message  M       `json:"message"`
	Disclose [][][]A `json:"disclose"`
}

// signatureMessage lists the languages in the order the PHP site did.
type signatureMessage struct {
	NL string `json:"nl"`
	EN string `json:"en"`
}

type signatureAttribute struct {
	Type  string  `json:"type"`
	Value *string `json:"value"`
}

type nextSession struct {
	URL string `json:"url"`
}

type chainedRequest struct {
	NextSession nextSession       `json:"nextSession"`
	Request     disclosureRequest `json:"request"`
}

// petitionRequest is a chained request whose next-session URL needs the
// language of the visitor.
type petitionRequest struct {
	chainedRequest
}

func (p petitionRequest) forLang(language lang) any {
	p.NextSession.URL += string(language)

	return p.chainedRequest
}

// langRequest is implemented by the requests that differ per language when
// they are sent to the IRMA server.
type langRequest interface {
	forLang(language lang) any
}

// signatureDemoRequest is the signature request of the demo, whose message
// is shown in both languages and sent in one.
type signatureDemoRequest struct {
	signatureRequest[signatureMessage, signatureAttribute]
}

func (m signatureMessage) in(language lang) string {
	if language == langNL {
		return m.NL
	}

	return m.EN
}

func (s signatureDemoRequest) forLang(language lang) any {
	return signatureRequest[string, signatureAttribute]{
		Context:  s.Context,
		Message:  s.Message.in(language),
		Disclose: s.Disclose,
	}
}

// newRequests returns the session request of every demo by slug, as shown in
// the "For developers" section. Signature messages carry the date of now.
func newRequests(cfg config, now time.Time) map[string]any {
	date := now.UTC().Format(signatureDateLayout)
	nlMessage := fmt.Sprintf("Hierbij verklaar ik dat student Pietje Puk, vandaag %s, met lof geslaagd is voor het vak Grondbeginselen van de Alchemie.", date)
	enMessage := fmt.Sprintf("Hereby I declare that today, %s, the student John Smith passed with distinction the exam of the course Foundations of Alchemy.", date)

	return map[string]any{
		"18plus": disclosureRequest{
			Context: contextDisclosure,
			Disclose: [][][]string{
				{
					{"pbdf.gemeente.personalData.over18"},
					{"pbdf.pbdf.passport.over18"},
					{"pbdf.pbdf.drivinglicence.over18"},
					{"pbdf.pbdf.idcard.over18"},
				},
			},
		},
		"address": disclosureRequest{
			Context: contextDisclosure,
			Disclose: [][][]string{
				{
					{
						"pbdf.nijmegen.address.street",
						"pbdf.nijmegen.address.houseNumber",
						"pbdf.nijmegen.address.zipcode",
						"pbdf.nijmegen.address.city",
					},
					{
						"pbdf.gemeente.address.street",
						"pbdf.gemeente.address.houseNumber",
						"pbdf.gemeente.address.zipcode",
						"pbdf.gemeente.address.city",
					},
					{
						"pbdf.pbdf.idin.address",
						"pbdf.pbdf.idin.zipcode",
						"pbdf.pbdf.idin.city",
					},
				},
			},
		},
		"student": disclosureRequest{
			Context: contextDisclosure,
			Disclose: [][][]string{
				{
					{"pbdf.pbdf.surfnet-2.type"},
				},
			},
			Labels: map[string]localized[string]{
				"1": {EN: "Student", NL: "Student"},
			},
		},
		"school": disclosureRequest{
			Context: contextDisclosure,
			Disclose: [][][]string{
				{
					{
						"pbdf.pbdf.surfnet-2.type",
						"pbdf.pbdf.surfnet-2.institute",
					},
				},
			},
			Labels: map[string]localized[string]{
				"1": {EN: "Student", NL: "Student"},
			},
		},
		"domain": disclosureRequest{
			Context: contextDisclosure,
			Disclose: [][][]string{
				{
					{"pbdf.pbdf.email.domain"},
					{"pbdf.sidn-pbdf.email.domain"},
				},
			},
		},
		"mail": disclosureRequest{
			Context: contextDisclosure,
			Disclose: [][][]string{
				{
					{"pbdf.pbdf.email.email"},
					{"pbdf.sidn-pbdf.email.email"},
				},
			},
		},
		"iban": disclosureRequest{
			Context: contextDisclosure,
			Disclose: [][][]string{
				{
					{
						"pbdf.pbdf.iban.fullname",
						"pbdf.pbdf.iban.iban",
						"pbdf.pbdf.iban.bic",
					},
				},
			},
		},
		"chained": chainedRequest{
			NextSession: nextSession{URL: cfg.irmatubeNextURL},
			Request: disclosureRequest{
				Context: contextDisclosure,
				Disclose: [][][]string{
					{
						{"pbdf.gemeente.personalData.fullname"},
						{"pbdf.pbdf.passport.lastName"},
						{"pbdf.pbdf.drivinglicence.lastName"},
						{"pbdf.pbdf.idcard.lastName"},
						{"pbdf.pbdf.linkedin.familyname"},
					},
				},
			},
		},
		"beingalive": disclosureRequest{
			Context: contextDisclosure,
			Disclose: [][][]string{
				{
					{
						"pbdf.gemeente.personalData.initials",
						"pbdf.gemeente.personalData.familyname",
						"pbdf.gemeente.personalData.dateofbirth",
					},
				},
			},
		},
		"signature": signatureDemoRequest{signatureRequest[signatureMessage, signatureAttribute]{
			Context: contextSignature,
			Message: signatureMessage{NL: nlMessage, EN: enMessage},
			Disclose: [][][]signatureAttribute{
				{
					{
						{Type: "pbdf.pbdf.surfnet-2.fullname"},
						{Type: "pbdf.pbdf.surfnet-2.institute"},
						{Type: "pbdf.pbdf.surfnet-2.email"},
						{Type: "pbdf.pbdf.surfnet-2.type", Value: new("employee")},
					},
				},
			},
		}},
		"petition": petitionRequest{chainedRequest{
			NextSession: nextSession{URL: cfg.baseURL + nextSessionPath + "?" + queryType + "=" + petitionSignatureType + "&" + queryLang + "="},
			Request: disclosureRequest{
				Context: contextDisclosure,
				Disclose: [][][]string{
					{
						{"pbdf.nijmegen.address.city"},
						{"pbdf.gemeente.address.city"},
						{"pbdf.pbdf.idin.city"},
					},
				},
			},
		}},
		"vog": disclosureRequest{
			Context: contextDisclosure,
			Disclose: [][][]string{
				{
					{
						"pbdf.gemeente.personalData.fullname",
						"pbdf.gemeente.personalData.dateofbirth",
					},
					{
						"pbdf.pbdf.passport.firstName",
						"pbdf.pbdf.passport.lastName",
						"pbdf.pbdf.passport.dateOfBirth",
					},
					{
						"pbdf.pbdf.idcard.firstName",
						"pbdf.pbdf.idcard.lastName",
						"pbdf.pbdf.idcard.dateOfBirth",
					},
					{
						"pbdf.pbdf.drivinglicence.firstName",
						"pbdf.pbdf.drivinglicence.lastName",
						"pbdf.pbdf.drivinglicence.dateOfBirth",
					},
				},
				{
					{
						"pbdf.pbdf.vog.givenNames",
						"pbdf.pbdf.vog.surname",
						"pbdf.pbdf.vog.dateOfBirth",
						"pbdf.pbdf.vog.issueDate",
						"pbdf.pbdf.vog.aspect84",
					},
				},
			},
			Labels: map[string]localized[string]{
				"0": {EN: "Identity", NL: "Identiteit"},
				"1": {EN: "Certificate of conduct (VOG)", NL: "Verklaring Omtrent het Gedrag (VOG)"},
			},
		},
		"exam": disclosureRequest{
			Context: contextDisclosure,
			Disclose: [][][]string{
				{
					{
						"pbdf.pbdf.surfnet-2.fullname",
						"pbdf.pbdf.surfnet-2.institute",
						"pbdf.pbdf.surfnet-2.type",
						"pbdf.pbdf.surfnet-2.id",
					},
				},
			},
			Labels: map[string]localized[string]{
				"0": {EN: "Student registration", NL: "Studentregistratie"},
			},
		},
		"course": disclosureRequest{
			Context: contextDisclosure,
			Disclose: [][][]string{
				{
					{
						"pbdf.pbdf.passport.firstName",
						"pbdf.pbdf.passport.lastName",
						"pbdf.pbdf.passport.dateOfBirth",
						"pbdf.pbdf.passport.nationality",
					},
					{
						"pbdf.pbdf.idcard.firstName",
						"pbdf.pbdf.idcard.lastName",
						"pbdf.pbdf.idcard.dateOfBirth",
						"pbdf.pbdf.idcard.nationality",
					},
					{
						"pbdf.gemeente.personalData.firstnames",
						"pbdf.gemeente.personalData.prefix",
						"pbdf.gemeente.personalData.familyname",
						"pbdf.gemeente.personalData.dateofbirth",
						"pbdf.gemeente.personalData.nationality",
					},
					{
						"pbdf.nijmegen.personalData.firstnames",
						"pbdf.nijmegen.personalData.prefix",
						"pbdf.nijmegen.personalData.familyname",
						"pbdf.nijmegen.personalData.dateofbirth",
						"pbdf.nijmegen.personalData.nationality",
					},
				},
				{
					{"pbdf.pbdf.email.email"},
					{"pbdf.sidn-pbdf.email.email"},
				},
			},
			Labels: map[string]localized[string]{
				"0": {EN: "Identity", NL: "Identiteit"},
				"1": {EN: "Contact", NL: "Contact"},
			},
		},
		"international": disclosureRequest{
			Context: contextDisclosure,
			Disclose: [][][]string{
				{
					{
						"pbdf.pbdf.passport.firstName",
						"pbdf.pbdf.passport.lastName",
						"pbdf.pbdf.passport.dateOfBirth",
						"pbdf.pbdf.passport.nationality",
						"pbdf.pbdf.passport.isEuCitizen",
						"pbdf.pbdf.passport.dateOfExpiry",
					},
					{
						"pbdf.pbdf.idcard.firstName",
						"pbdf.pbdf.idcard.lastName",
						"pbdf.pbdf.idcard.dateOfBirth",
						"pbdf.pbdf.idcard.nationality",
						"pbdf.pbdf.idcard.isEuCitizen",
						"pbdf.pbdf.idcard.dateOfExpiry",
					},
				},
				{
					{
						"pbdf.nijmegen.address.street",
						"pbdf.nijmegen.address.houseNumber",
						"pbdf.nijmegen.address.zipcode",
						"pbdf.nijmegen.address.city",
					},
					{
						"pbdf.gemeente.address.street",
						"pbdf.gemeente.address.houseNumber",
						"pbdf.gemeente.address.zipcode",
						"pbdf.gemeente.address.city",
					},
				},
			},
			Labels: map[string]localized[string]{
				"0": {EN: "Travel document", NL: "Reisdocument"},
				"1": {EN: "Municipal registration", NL: "Gemeentelijke inschrijving"},
			},
		},
		"employee": disclosureRequest{
			Context: contextDisclosure,
			Disclose: [][][]string{
				{
					{
						"pbdf.pbdf.passport.firstName",
						"pbdf.pbdf.passport.lastName",
						"pbdf.pbdf.passport.dateOfBirth",
						"pbdf.pbdf.passport.nationality",
						"pbdf.pbdf.passport.documentType",
						"pbdf.pbdf.passport.documentNumber",
						"pbdf.pbdf.passport.dateOfExpiry",
					},
					{
						"pbdf.pbdf.idcard.firstName",
						"pbdf.pbdf.idcard.lastName",
						"pbdf.pbdf.idcard.dateOfBirth",
						"pbdf.pbdf.idcard.nationality",
						"pbdf.pbdf.idcard.documentType",
						"pbdf.pbdf.idcard.documentNumber",
						"pbdf.pbdf.idcard.dateOfExpiry",
					},
				},
				{
					{
						"pbdf.gemeente.address.street",
						"pbdf.gemeente.address.houseNumber",
						"pbdf.gemeente.address.zipcode",
						"pbdf.gemeente.address.city",
					},
					{
						"pbdf.nijmegen.address.street",
						"pbdf.nijmegen.address.houseNumber",
						"pbdf.nijmegen.address.zipcode",
						"pbdf.nijmegen.address.city",
					},
					{
						"pbdf.pbdf.idin.address",
						"pbdf.pbdf.idin.zipcode",
						"pbdf.pbdf.idin.city",
					},
				},
				{
					{
						"pbdf.pbdf.iban.fullname",
						"pbdf.pbdf.iban.iban",
					},
				},
			},
			Labels: map[string]localized[string]{
				"0": {EN: "Identity document", NL: "Identiteitsbewijs"},
				"1": {EN: "Home address", NL: "Woonadres"},
				"2": {EN: "Salary account", NL: "Salarisrekening"},
			},
		},
		"campus": disclosureRequest{
			Context: contextDisclosure,
			Disclose: [][][]string{
				{
					{
						"pbdf.pbdf.surfnet-2.type",
						"pbdf.pbdf.surfnet-2.institute",
					},
				},
			},
			Labels: map[string]localized[string]{
				"0": {EN: "Campus role", NL: "Rol op de campus"},
			},
		},
		"admission": disclosureRequest{
			Context: contextDisclosure,
			Disclose: [][][]string{
				{
					{
						"pbdf-staging.pbdf.diploma.documentType",
						"pbdf-staging.pbdf.diploma.qualification",
						"pbdf-staging.pbdf.diploma.nlqfLevel",
						"pbdf-staging.pbdf.diploma.institution",
						"pbdf-staging.pbdf.diploma.dateAwarded",
						"pbdf-staging.pbdf.diploma.fullName",
					},
				},
			},
			Labels: map[string]localized[string]{
				"0": {EN: "Prior education", NL: "Vooropleiding"},
			},
		},
	}
}
