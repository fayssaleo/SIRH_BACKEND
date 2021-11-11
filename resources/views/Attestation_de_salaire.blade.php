<!doctype html>
<html >
<head>
    <style>
        .container {
            width: 550px;
            background-color: aqua;
        }
        .logo{
            width: 100%;
            text-align: left;
            margin-bottom: 30px;

        }
        .img{
            height: 121px;
            width: 332px;
        }
        .Title{
            width: 100%;
            text-align: center;
            font-size: 20px;
            text-decoration: underline;
            margin-bottom: 30px;
        }
        .text{
            width: 82%;
            font-size: 19px;
            margin: 0 auto;
            line-height: 2;
            word-spacing: 4px;
            margin-bottom: 34px;
            font-family: "Times New Roman", Times, serif;
        }


    </style>
</head>
<body style="margin: 0; padding: 0;">
<div style="width:100%;margin: auto; ">
    <div class="logo">
        <img class="img" src="{{@asset('/images/Devcorp-LOGO-big-6.png')}}" alt="">
    </div>
    <div class="Title">
        <h1>Attestation de salaire</h1>
    </div>
    <div class="text">
        <p>Nous soussignés entreprise <span style="font-weight: bold;">DEVCORP</span>, domiciliée à <span style="font-weight: bold;">39 Rue Al Banafsaj, Casablanca</span>,&#8239;&#8239;&#8239;&#8239;&#8239;&#8239; certifions &#8239;&#8239;&#8239;&#8239; par &#8239;&#8239;&#8239;&#8239; la &#8239;&#8239;&#8239;&#8239; présente &#8239;&#8239;&#8239;&#8239;&#8239; que Monsieur/Madame <span style="font-weight: bold;">{{$data['collaborateur']->prenom}} {{$data['collaborateur']->nom}}</span>, titulaire de la <span style="font-weight: bold;">CIN N°{{$data['collaborateur']->cin}}</span>, immatriculé(e) à la <span style="font-weight: bold;">CNSS sous le N° 486154654986419864</span>, est employé au sein de notre société en qualité de <span style="font-weight: bold;">{{$data['collaborateur']->prenom}}</span>, et ce depuis le <span style="font-weight: bold;">13/08/2021</span>. à ce jour. Son salaire mensuel brut est de <span style="font-weight: bold;">10000</span>. MAD, pour <span style="font-weight: bold;">192</span> heures effectuées mensuellement. Cette attestation est délivrée à l’intéressé(e) pour servir et valoir ce que de droit.</p>
    </div>

    <div class="text">
        Fait le : <span style="font-weight: bold;">13/08/2021</span>. à Casablanca
    </div>
    <div class="text" style=" margin-bottom: 86px; ">
        Signature :
    </div>
    <div class="text" style=" margin-bottom: 110px; ">
        Cachet de l’entreprise
    </div>


</div>

</body>
</html>