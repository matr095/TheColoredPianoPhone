<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer ton blog en 3D - BlogStation - The Colored Piano Phone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary bpink">
    <div class="container-fluid">
        <a class="navbar-brand cred" href="/">The Colored Piano Phone</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-link" aria-current="page" href="/">Accueil</a>
            <a class="nav-link" href="https://youtube.com/@piano-phone">YouTube</a>
            <a class="nav-link active" href="blogstation">BlogStation</a>
        </div>
        </div>
    </div>
    </nav>
    <article>
    <div class="clearfix"></div>
        <div class="container-fluid mt-2" style="max-width:1000px">
            <div class="row mt-2 mb-4">
                <div class="col-12">
                <div class="card p-2">
                    <p class="absolute">Crée ton blog en 3D</p>
                    <img src="bck/head.jpeg" width="100%" style="max-height:600px"/>
                </div>
                </div>
            </div>
            <div class="row mt-2 mb-2">
                <div class="col-md-4 mb-1">
                    <div class="card">
                        <div class="card-header">S'inscrire</div>
                        <div class="card-body">
                            <label>{{ $register }}</label>
                            <form action="/register" method="post">
                                @csrf
                                <input type="email" name="email" id="email" placeholder="Email">
                                <input type="password" name="password" id="password" placeholder="Mot de passe">
                                <input type="submit" value="Soumettre">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-1">
                    <div class="card">
                        <div class="card-header">Se connecter</div>
                        <div class="card-body">
                        <label>{{ $login }}</label>
                            <form action="/login" method="post">
                                @csrf
                                <input type="email" name="email" id="email" placeholder="Email">
                                <input type="password" name="password" id="password" placeholder="Mot de passe">
                                <input type="submit" value="Soumettre">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-1">
                    <div class="card">
                        <div class="card-header">Derniers blogs créés</div>
                        <div class="card-body">
                            <ul>
                            @foreach($lastblog as $blog)
                                <li><a href="/blog/{{$blog->email}}">{{$blog->email}}</a></li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <footer class="mt-4 text-center text-center bg-dark text-white p-5">
        2023 - The Colored Piano Phone
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>