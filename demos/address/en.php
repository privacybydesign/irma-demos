<p>
This page describes how a visitor can easily disclose his/her address
with Yivi. In particular, an address form is filled-in automatically
with reliable address data.
</p>

<p>
In order to be able to try out the button below you need to have the
Yivi
app <a href="https://yivi.app/#download">installed</a>
with at least your <b>address</b> card loaded.  This can be done via
the Dutch <a href="https://yivi.nijmegen.nl/login">BRP
issuance webpage</a>.
</p>

<table style="margin:auto">
  <tr>
    <td> <b>Address</b> </td>
    <td> <input id="adres_regel" disabled> </td>
    <td></td>
  </tr>
  <tr>
    <td> <b>Zip code</b> </td>
    <td> <input id = "postcode_regel" disabled> </td>
    <td><button class="custom-button" id="try_irma_adresbtn">Fill in with Yivi</button></td>
  </tr>
  <tr>
    <td> <b>City</b> </td>
    <td> <input id="plaats_regel" disabled> </td>
    <td></td>
  </tr>
</table>

<p>
A few remarks:
<ul>
<li> This demo fills in the above address fields, but
does <em>not</em> store or collect any data. As soon as the demo is
closed, all information disappears.

<li> This automatic form-filling with Yivi also works for other
fields, like name, email address, phone number etc. This is much
easier than typing the information by hand and prevents
mistakes. Moreover, the website knows the data is reliable: it can
see the source of the data, and on that basis decide its level of
confidence. In this demo the source is the Dutch national civil
registry BRP.
</ul>
</p>


<p>
<a href="../../">Back</a> to
the Yivi demo overview.
</p>