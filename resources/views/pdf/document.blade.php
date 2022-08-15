<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <title>Certificat D'authenticite</title>
</head>

<body class="antialiased">
    <h1 class="text-center text-3xl py-10 font-semibold uppercase">{{ __('Certificat d\'authenticite') }}</h1>

    <div>
        @foreach($oeuvre->media as $media)
        @if($loop->first)

        <div>
            <img class="h-96 rounded-xl w-full" src="data:image/{{pathinfo(base_path('/public'.$media->image),PATHINFO_EXTENSION)}};base64,{{ base64_encode( file_get_contents(base_path('/public'.$media->image)) )}}" alt="{{ $oeuvre->titre }}">
            <p class="py-4">
                <span class="pl-2 pr-5" style="color:#4B5563 "> Code Certificat </span>
                <span class="font-semibold">{{ $codeCertificat }}</span>
            </p>
        </div>

        @endif
        @endforeach

        <div>
            <h1 class="mb-4 mt-10"> {{ __('Je soussigne')}},
                <span class="font-bold uppercase">{{ $oeuvre->artist->username }}</span>
                {{ __('certifie que la sculpture designee ci-apres est originale.')}}
            </h1>

            <table width="80%" align="center">
                <tr class="mb-2" width="100px">
                    <td style="color:#4B5563 ">Titre</td>
                    <td class="font-semibold uppercase">{{ __($oeuvre->titre) }}</td>
                </tr>
                <tr class="mb-2 " width="100px">
                    <td style="color:#4B5563 ">Annee</td>
                    <td class="font-semibold uppercase">{{ __($oeuvre->annee_creation) }}</td>
                </tr>
                <tr class="mb-2 " width="100px">
                    <td style="color:#4B5563 ">Technique</td>
                    <td class="font-semibold uppercase">{{ __($oeuvre->technique_materiaux) }}</td>
                </tr>
                <tr class="mb-2 " width="100px">
                    <td style="color:#4B5563" >Emplacement signature</td>
                    <td class="font-semibold uppercase">{{ __($oeuvre->Emplacement_signature) }}</td>
                </tr>

                @if(!empty($oeuvre->support))
                <tr class="mb-2 " width="100px">
                    <td style="color:#4B5563">{{ __('Support')}}</td>
                    <td class="font-semibold uppercase" >{{ __($oeuvre->support) }}</td>
                </tr>
                @endif

                <tr class="mb-2 " width="100px">
                    <td style="color:#4B5563">{{ __('Dimension')}}</td>
                    <td class="font-semibold uppercase">
                        {{ __($oeuvre->longueur) }} ×
                        {{ __($oeuvre->largeur) }}
                        @if(!empty($oeuvre->hauteur))
                        ×
                        {{ __($oeuvre->hauteur) }}
                        @endif
                    </td>
                </tr>


                @if(!empty($oeuvre->numero_serie))
                <tr class="mb-2 " width="100px">
                    <td style="color:#4B5563">{{ __('Numero de serie')}}</td>
                    <td class="font-semibold uppercase" >
                        {{ __($oeuvre->numero_serie) }}
                    </td>
                </tr>
                @endif

            </table>
        </div>
    </div>

    <div style="page-break-after: always;"></div>
    <div class="text-center">
        @foreach($oeuvre->media as $media)
            @if(!$loop->first)
            <div class="mb-8">
                <p style="color:#9CA3AF" class="text-left text-xl">{{ $media->intitule }}</p>
                <hr class="py-2">
                <img class="h-96 w-full" src="data:image/{{pathinfo(base_path('/public'.$media->image),PATHINFO_EXTENSION)}};base64,{{ base64_encode( file_get_contents(base_path('/public'.$media->image)) )}}" alt="{{ $oeuvre->titre }}">
            </div>
            @endif
        @endforeach
    </div>
</body>
</html>