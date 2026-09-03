let verifier = (data) => {
	document.querySelector('.content').removeAttribute('hidden');
	document.querySelector('.demo-main > h2:first-child').remove();

	document.getElementById('domain').innerText = data.disclosed[0][0].rawvalue;
	document.getElementById('domain-2').innerText = data.disclosed[0][0].rawvalue;

	return false;
};

start_session_inline(slug, lang, verifier);
