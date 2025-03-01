<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <style>
        body {
            display: flex;
            flex-flow: column nowrap;
            justify-content: center;
            align-items: center;
            margin: 0;
            width: 100%;
            min-height: 100vh;
            background: rgb(11, 12, 32);
            background: linear-gradient(300deg, rgba(11, 12, 32, 1) 0%, rgba(34, 37, 74, 1) 61%);
            color: rgba(255, 255, 255, 0.9);
        }

        header {
            text-align: center;
        }

        main {
            display: flex;
            flex-flow: column nowrap;
            justify-content: center;
            align-items: flex-start;
            width: 100%;
        }

        code {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 0.5rem;
            border: 1px solid rgba(46, 0, 155, 0.55);
            border-radius: 5px;
        }

        details {
            margin: 1rem;
        }

        details>summary {
            font-size: 1.8rem;
        }
    </style>
</head>

<body>
    <header>
        <h1>ERP API Endpoints</h1>
        <small>ERP Backend Showcase </small>
    </header>
    <main>
        <details open>
            <summary>Auth</summary>
            <ul>
                <li>
                    <p>
                        <code>/auth/register</code> : to register a user
                    </p>
                </li>
                <li>
                    <p>
                        <code>/auth/login</code> : to login a user
                    </p>
                </li>
                <li>
                    <p>
                        <code>/sanctum/csrf-cookie</code> : to get an xsrf token to be attached with form requsts'
                        header
                    </p>
                </li>

            </ul>
        </details>
    </main>
</body>

</html>
