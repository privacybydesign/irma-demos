<?php
$developer_details_strings = [
    'for_developers' => [
        'en' => 'For developers',
        'nl' => 'Voor ontwikkelaars'
    ],
    'request' => [
        'en' => 'Request',
        'nl' => 'Request'
    ],
    'copy' => [
        'en' => 'Copy',
        'nl' => 'Copy'
    ]
];
?>

<details>
    <summary>
        <?php echo $developer_details_strings['for_developers'][$lang]; ?>
    </summary>
    <p>
        <?php echo $developer_details_strings['request'][$lang]; ?>
        <button id="copy-request" class="small">
            <?php echo $developer_details_strings['copy'][$lang]; ?>
        </button>
    </p>
    <?php
    include($_SERVER['DOCUMENT_ROOT'].'/start_session.php');
    $request = json_encode(
        $sprequests[$slug],
        JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
    );
    ?>
    <pre><code id="request"><?php echo htmlspecialchars($request, ENT_QUOTES); ?></code></pre>
    <script>
		(() => {
			document.getElementById('copy-request').addEventListener('click', requestToClipboard);

			async function requestToClipboard(event) {
				event.target.innerText = "Copied!";
				try {
					await navigator.clipboard.writeText(
						document.getElementById('request').innerText
					);
				} catch (error) {
					console.error(error.message);
				}
			}
		})();
    </script>
</details>