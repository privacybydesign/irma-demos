package main

import "strings"

type lang string

const (
	langEN lang = "en"
	langNL lang = "nl"

	queryLang = "lang"
)

// parseLang falls back to English for anything but "nl".
func parseLang(value string) lang {
	if strings.EqualFold(value, string(langNL)) {
		return langNL
	}

	return langEN
}

type localized[T any] struct {
	EN T `json:"en"`
	NL T `json:"nl"`
}

func (l localized[T]) in(language lang) T {
	if language == langNL {
		return l.NL
	}

	return l.EN
}
