
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>GraphQL Playground</title>
    <link rel="stylesheet" href="//unpkg.com/graphql-playground-react/build/static/css/index.css" />
    <link rel="shortcut icon" href="//graphql-playground.com/favicon.png" />
    <script src="//unpkg.com/graphql-playground-react/build/static/js/middleware.js"></script>
  </head>
  <body>
    <div id="root"></div>
    <script>
      window.addEventListener('load', function (event) {
        GraphQLPlayground.init(document.getElementById('root'), {
          endpoint: '/graphql'
        })
      })
    </script>
  </body>
</html>
