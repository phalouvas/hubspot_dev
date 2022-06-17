  <head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <script type="module" crossorigin src="https://integration.sms.to/component_bulk_sms/{{ $js_link}}"></script>
    <link rel="stylesheet" href="https://integration.sms.to/component_bulk_sms/{{ $assets_link}}" />
  </head>
  <body>
    <div id="app_smsto" data-getParams="{{ $VITE_ROUTE_PARAMS }}" data-callSmsto="{{ $VITE_ROUTE_SMSTO }}" data-sender_id={{ $sender_id }} data-active_tab={{ $active_tab }} data-to={{ $to }} ></div>
  </body>
</html>
