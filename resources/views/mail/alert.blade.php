<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            background: #dc3545;
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .body {
            padding: 30px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .table th {
            background: #f8f9fa;
            padding: 12px;
            text-align: left;
            border: 1px solid #dee2e6;
            color: #495057;
        }
        .table td {
            padding: 12px;
            border: 1px solid #dee2e6;
            color: #212529;
        }
        .badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }
        .badge-danger {
            background: #dc3545;
            color: white;
        }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: #dc3545;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            margin-top: 20px;
        }
        .footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #6c757d;
            font-size: 13px;
            border-top: 1px solid #dee2e6;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>⚠️ Alerte Critique Détectée</h1>
            <p style="margin:10px 0 0 0; opacity:0.9;">ServerWatch — Système de Monitoring</p>
        </div>

        <!-- Body -->
        <div class="body">
            <p>Bonjour <strong>Admin</strong>,</p>
            <p>Une alerte critique a été détectée sur votre serveur. Veuillez vérifier immédiatement.</p>

            <!-- Table -->
            <table class="table">
                <tr>
                    <th>Détail</th>
                    <th>Valeur</th>
                </tr>
                <tr>
                    <td><strong>Serveur</strong></td>
                    <td>{{ $alert->serveur->nom ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Message</strong></td>
                    <td>{{ $alert->message }}</td>
                </tr>
                <tr>
                    <td><strong>Seuil</strong></td>
                    <td>{{ $alert->seuil }}%</td>
                </tr>
                <tr>
                    <td><strong>Date</strong></td>
                    <td>{{ $alert->date }}</td>
                </tr>
                <tr>
                    <td><strong>Statut</strong></td>
                    <td>
                        <span class="badge badge-danger">{{ $alert->statut }}</span>
                    </td>
                </tr>
            </table>

            <!-- Button -->
            <div style="text-align:center;">
                <a href="{{ url('/alerts') }}" class="btn">
                    Voir les Alertes
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>© {{ date('Y') }} ServerWatch — Système de Monitoring Automatique</p>
            <p>Cet email a été envoyé automatiquement, merci de ne pas répondre.</p>
        </div>
    </div>
</body>
</html>