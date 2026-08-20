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

include($_SERVER['DOCUMENT_ROOT'].'/start_session.php');

// Set by demo-page.php: one entry per session type the demo can start.
$request_types = $session_types ?? [$slug];
?>

<details>
    <summary>
        <?php echo $developer_details_strings['for_developers'][$lang]; ?>
    </summary>
    <?php foreach ($request_types as $type):
        if (!array_key_exists($type, $sprequests)) continue;
        $request = $sprequests[$type];
        // Mirror what start_session.php sends: a signature request carries the
        // message for one language, not the pair it is stored as.
        if (str_contains($type, 'signature')) {
            $request['message'] = $request['message'][$lang];
        }
        $json = json_encode(
            $request,
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
        );
        ?>
        <p>
            <span>
                <?php echo $developer_details_strings['request'][$lang]; ?>
                <?php if (count($request_types) > 1) echo '<code>' . htmlspecialchars($type, ENT_QUOTES) . '</code>'; ?>
            </span>
            <button class="copy-request small">
                <?php echo $developer_details_strings['copy'][$lang]; ?>
            </button>
        </p>
        <pre><code><?php echo htmlspecialchars($json, ENT_QUOTES); ?></code></pre>
    <?php endforeach; ?>
    <script>
		(() => {
			document.querySelectorAll('.copy-request').forEach((button) => {
				button.addEventListener('click', requestToClipboard);
			});

			async function requestToClipboard(event) {
				let request = event.target.closest('p').nextElementSibling;
				event.target.innerText = "Copied!";
				try {
					await navigator.clipboard.writeText(request.innerText);
				} catch (error) {
					console.error(error.message);
				}
			}
		})();
    </script>
</details>
