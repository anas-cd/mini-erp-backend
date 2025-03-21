<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ERP API</title>

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

        .http_get {
            color: green;
        }

        .http_patch {
            color: purple;
        }

        .http_post {
            color: yellow;
        }

        .http_delete {
            color: red;
        }

        .http {
            background-color: rgba(255, 255, 255, 0.7);
            padding: 0.2rem;
            border: 1px solid rgba(46, 0, 155, 0.55);
            border-radius: 5px;
            font-weight: bold;
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
                        <span class="http http_post">Post</span> <code>/auth/register</code> : to register a user
                    </p>
                </li>
                <li>
                    <p>
                        <span class="http http_post">Post</span> <code>/auth/login</code> : to login a user
                    </p>
                </li>
                <li>
                    <p>
                        <span class="http http_get">Get</span> <code>/auth/logout</code> : to logout a user
                    </p>
                </li>
                <li>
                    <p>
                        <span class="http http_get">Get</span><code>/sanctum/csrf-cookie</code> : to get an xsrf token
                        to be attached with form requsts'
                        header
                    </p>
                </li>

            </ul>
        </details>
        <details open>
            <summary>Dashboard</summary>
            <ul>
                <li>
                    <p>
                        <span class="http http_get">Get</span> <code>/summary/tenant</code> : important tenants info
                    </p>
                </li>
                <li>
                    <p>
                        <span class="http http_get">Get</span> <code>/summary/leases</code> : upcoming leases dates
                        summary
                    </p>
                </li>
            </ul>
        </details>
        <details open>
            <summary>Tenants</summary>
            <ul>
                <li>
                    <p>
                        <span class="http http_post">Post</span> <code>/tenant</code> : to register a tenant
                    </p>
                </li>
                <li>
                    <p>
                        <span class="http http_get">Get</span> <code>/tenant/{id?}</code> : to show tenant info, if no
                        id is provided it will assume the authenticated user tenant profile.
                    </p>
                </li>
                <li>
                    <p>
                        <span class="http http_patch">Patch</span> <code>/tenant/{id}</code> : to update tenant info.
                    </p>
                </li>
                <li>
                    <p>
                        <span class="http http_delete">Delete</span> <code>/tenant/{id}</code> : to soft delete tenant
                        profile, profile record will be permanently deleted after 6 months.
                    </p>
                </li>
            </ul>
        </details>
        <details open>
            <summary>Leases</summary>
            <ul>
                <li>
                    <p>
                        <span class="http http_post">Post</span> <code>/lease</code> : to register a lease
                    </p>
                </li>
                <li>
                    <p>
                        <span class="http http_get">Get</span> <code>/lease/{id?}</code> : to show lease info by query
                        id, or any of the following in the body request ['tenant_email', 'property_id'], Note
                        'tenant_id' will return leases collection of said tenant
                    </p>
                </li>
                <li>
                    <p>
                        <span class="http http_patch">Patch</span> <code>/lease/{id}</code> : to update lease info.
                    </p>
                </li>
                <li>
                    <p>
                        <span class="http http_delete">Delete</span> <code>/lease/{id}</code> : to soft delete lease
                        record, record will be permanently deleted after 6 months.
                    </p>
                </li>
            </ul>
        </details>
        <details open>
            <summary>Maintenance Requests</summary>
            <ul>
                <li>
                    <p>
                        <span class="http http_post">Post</span> <code>/maintenance-request</code> : to register a
                        maintenance request
                    </p>
                </li>
                <li>
                    <p>
                        <span class="http http_get">Get</span> <code>/maintenance-request/{id}</code> : to show a
                        maintenance request info by query
                        id
                    </p>
                </li>
                <li>
                    <p>
                        <span class="http http_patch">Patch</span> <code>/maintenance-request/{id}</code> : to update a
                        maintenance request info.
                    </p>
                </li>
                <li>
                    <p>
                        <span class="http http_delete">Delete</span> <code>/maintenance-request/{id}</code> : to soft
                        delete a maintenance request
                        record, record will be only soft deleted.
                    </p>
                </li>
            </ul>
        </details>
        <details open>
            <summary>Technician Assignment</summary>
            <ul>
                <li>
                    <p>
                        <span class="http http_post">Post</span> <code>/technician-assignment</code> : to register a
                        technician assignment
                    </p>
                </li>
                <li>
                    <p>
                        <span class="http http_get">Get</span> <code>/technician-assignment/{id}</code> : to show a
                        technician assignment info by query
                        id
                    </p>
                </li>
                <li>
                    <p>
                        <span class="http http_patch">Patch</span> <code>/technician-assignment/{id}</code> : to update
                        a
                        technician assignment info.
                    </p>
                </li>
                <li>
                    <p>
                        <span class="http http_delete">Delete</span> <code>/technician-assignment/{id}</code> : to soft
                        delete a technician assignment
                        record, record will be only soft deleted.
                    </p>
                </li>
            </ul>
        </details>
        <details open>
            <summary>Technicians</summary>
            <ul>
                <li>
                    <p>
                        <span class="http http_post">Post</span> <code>/technician</code> : to register a technician
                    </p>
                </li>
                <li>
                    <p>
                        <span class="http http_get">Get</span> <code>/technician/{id}</code> : to show technician info
                        by query
                        id
                    </p>
                </li>
                <li>
                    <p>
                        <span class="http http_patch">Patch</span> <code>/technician/{id}</code> : to update technician
                        info.
                    </p>
                </li>
                <li>
                    <p>
                        <span class="http http_delete">Delete</span> <code>/technician/{id}</code> : to soft delete
                        technician
                        record, record will be only soft deleted.
                    </p>
                </li>
            </ul>
        </details>
    </main>
</body>

</html>
