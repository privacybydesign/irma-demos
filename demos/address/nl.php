<p>
  Deze pagina beschrijft hoe een webbezoeker eenvoudig
  zijn/haar adres door kan geven met Yivi. Hierbij wordt een
  adres formulier automatisch ingevuld, met betrouwbare
  informatie.
</p>

<p>
  Om de onderstaande knoppen te kunnen uitproberen moet de
  bezoeker de Yivi
  app <a href="https://yivi.app/#download">ge&iuml;nstalleerd</a>
  hebben en daarin het <b>adres</b> kaartje geladen
  hebben. Dat kan via
  de <a href="https://yivi.nijmegen.nl/login">BRP
  uitgifte webpagina</a>.
</p>

<table style="margin:auto">
  <tr>
    <td> <b>Adres</b> </td>
    <td> <input id="adres_regel" disabled> </td>
    <td></td>
  </tr>
  <tr>
    <td> <b>Postcode</b> </td>
    <td> <input id = "postcode_regel" disabled> </td>
    <td><button class="custom-button" id="try_irma_adresbtn">Vul in met Yivi</button></td>
  </tr>
  <tr>
    <td> <b>Plaats</b> </td>
    <td> <input id="plaats_regel" disabled> </td>
    <td></td>
  </tr>
</table>

<p>
Een paar opmerkingen:
<ul>
<li> Deze demo vult enkel de bovenstaande adres velden in, maar
slaat <em>geen</em> gegevens op. Zodra de pagina gesloten wordt,
zijn de gegevens verdwenen.

<li> Dit automatische invullen met Yivi kan natuurlijk ook voor andere
velden, zoals naam, e-mailadres, telefoonnummer etc. Dit is veel
makkelijker dan het handmatig invullen en voorkomt fouten. De website
kan vertrouwen op de juistheid van de gegevens want de site kan zien
uit welke bron de gegevens komen en daarmee de betrouwbaarheid
bepalen. Hier is Basisregistratie Personen (BRP) de van de overheid
bron.

<li> Een concreet voorbeeld waar zulke betrouwbare adresgegevens
nuttig zouden kunnen zijn is bij energiemaatschappijen. Daar kan/kon
online met adresgegevens het energiegebruik van een woning ingezien
worden.  Wanneer adressen niet uit betrouwbare bron komen, geeft dit
makkelijk aanleiding tot
een <a href="https://www.nu.nl/internet/4989794/energieverbruik-alle-nederlandse-huishoudens-was-in-zien-datalek.html">datalek</a>. Zulke
datalekken moeten gemeld worden bij de Autoriteit Persoonsgegevens,
tasten de reputatie van de betreffende maatschappij aan, en kunnen
leiden tot hoge boetes onder de Algemene Verordening
Gegevensbescherming (AVG).
</ul>
</p>