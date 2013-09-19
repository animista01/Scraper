<!DOCTYPE html>
<html>
  <head>
    <title>U Reminder</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="{{ url('css/signin.css') }}">
  </head>
  <body>
    <div class="container">
      <form class="form-signin" method="post">
        <h2 class="form-signin-heading">Llena el siguiente formulario</h2>
        <input type="text" name="txtuser" class="form-control" placeholder="Tu usuario de Unisimon" autofocus="" required />
        <input type="password" name="txtpass" class="form-control" placeholder="Tu contraseña de Unisimon" required />
        <input type="text" name="txtname" class="form-control" placeholder="Tu nombre" required />
        <input type="email" name="txtmail" class="form-control" placeholder="Email donde te llegará el recordatorio" required />
        <button class="btn btn-lg btn-primary btn-block" type="submit">Guardar</button>
      </form>
    </div>
    <footer style="text-align: center; font-size: 1.2em; font-weight: 700; margin-top: 120px;">
      <p>
        Handcrafted by <a href="https://twitter.com/bryvinu">@BryVinu</a>
      </p>
      </footer>
    <script src="{{ url('js/jquery.js') }}"></script>
    <script src="{{ url('js/bootstrap.min.js') }}"></script>
  </body>
</html>