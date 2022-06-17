  <head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <script type="module" crossorigin src="https://integration.sms.to/component_bulk_sms/{{ $js_link}}"></script>
    <link rel="stylesheet" href="https://integration.sms.to/component_bulk_sms/{{ $assets_link}}" />
  </head>
  <body>
    <div id="app_smsto" data-getParams="{{ $VITE_ROUTE_PARAMS }}" data-callSmsto="{{ $VITE_ROUTE_SMSTO }}" />
  </body>
</html>
