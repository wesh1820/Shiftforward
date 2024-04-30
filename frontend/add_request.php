<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nieuwe Aanvraag Toevoegen</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- Zorg ervoor dat je de juiste link naar je CSS-bestand plaatst -->
    <style>

        .payment-content h2 {
            margin-top: 0;
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="number"],
        select,
        textarea,
        input[type="file"],
        input[type="checkbox"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #FF5E00;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #FF5E00;
        }
    </style>
</head>
<body>
    <?php
        include 'sidebar.php';
    ?>
    <div class="main">
        <div class="payment-content">
            <h2>Nieuwe Aanvraag</h2>
            <form action="process_request.php" method="POST">
                <label for="unemployment_reason">Reden van Werkloosheid:</label>
                <input type="text" id="unemployment_reason" name="unemployment_reason" required><br>
                
                <label for="last_employer">Laatste Werkgever:</label>
                <input type="text" id="last_employer" name="last_employer" required><br>
                
                <label for="last_salary">Laatst Verdiende Salaris:</label>
                <input type="number" id="last_salary" name="last_salary" required><br>
                
                <label for="bank_account">Bankrekeningnummer:</label>
                <input type="text" id="bank_account" name="bank_account" required><br>
                
                <label for="previous_employment_duration">Duur van Vorige Werkgelegenheid (in maanden):</label>
                <input type="number" id="previous_employment_duration" name="previous_employment_duration" required><br>
                
                <label for="reason_additional_income">Reden voor Eventuele Aanvullende Inkomsten:</label>
                <input type="text" id="reason_additional_income" name="reason_additional_income"><br>
                
                <label for="additional_income_amount">Bedrag van Eventuele Aanvullende Inkomsten:</label>
                <input type="number" id="additional_income_amount" name="additional_income_amount"><br>
                
                <label for="additional_notes">Aanvullende Opmerkingen:</label><br>
                <textarea id="additional_notes" name="additional_notes" rows="4" cols="50"></textarea><br>
                
                <label for="attachment">Bijlage:</label>
                <input type="file" id="attachment" name="attachment"><br>
                
                <label for="terms">Ik ga akkoord met de <a href="terms.php" target="_blank">algemene voorwaarden</a>:</label>
                <input type="checkbox" id="terms" name="terms" required><br>
                
                <label for="contact_preference">Contactvoorkeur:</label>
                <select id="contact_preference" name="contact_preference" required>
                    <option value="Telefoon">Telefoon</option>
                    <option value="E-mail">E-mail</option>
                    <option value="Post">Post</option>
                </select><br>
                
                <label for="preferred_contact_time">Voorkeurstijd voor contact:</label>
                <input type="time" id="preferred_contact_time" name="preferred_contact_time"><br>
                
                <label for="unemployment_start_date">Startdatum Werkloosheid:</label>
                <input type="date" id="unemployment_start_date" name="unemployment_start_date" required><br>
                
                <label for="unemployment_end_date">Verwachte Einddatum Werkloosheid:</label>
                <input type="date" id="unemployment_end_date" name="unemployment_end_date"><br>
                
                <label for="support_requested">Gewenste Ondersteuning:</label><br>
                <input type="checkbox" id="support_requested" name="support_requested[]" value="Sollicitatieondersteuning"> Sollicitatieondersteuning<br>
                <input type="checkbox" id="support_requested" name="support_requested[]" value="Omscholing"> Omscholing<br>
                <input type="checkbox" id="support_requested" name="support_requested[]" value="Financiële Hulp"> Financiële Hulp<br>
                <br>
                
                <label for="resume">CV (optioneel):</label>
                <input type="file" id="resume" name="resume"><br>
                
                <label for="other_documents">Andere Documenten (optioneel):</label>
                <input type="file" id="other_documents" name="other_documents"><br>
                
                <label for="privacy_agreement">Ik ga akkoord met het <a href="privacy.php" target="_blank">privacybeleid</a>:</label>
                <input type="checkbox" id="privacy_agreement" name="privacy_agreement" required><br>
                
                <input type="submit" value="Aanvraag Verzenden">
            </form>
        </div>
    </div>
</body>
</html>
