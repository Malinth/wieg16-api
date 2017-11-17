# Övningar för Lektion 3: API:er
## Övning 1
Nu är det dags att börja exponera den data som du hämtat hem i lektion 2 övning 3.
Gör en fil som heter customers.php som skriver ut all data från tabellen i json-format på skärmen.
Skicka lämplig header för att visa att det är json-data du skickar och inte vanlig html.

1. Du ska skriva ut datan som du sparade från dina tabeller, inte hämta hem den igen.
2. Koppla upp dig mot din databas med PDO.
3. Hämta datan med lämplig SQL-sats. SELECT *
4. Utmaning: Datan ska inte se likadan ut när du skriver ut den som den gör när den hämtas från API
Alltså: Adressen skall ligga med på kunden.
5. Du kan lösa det på två olika sätt:
    1. Göra en stor JOIN i din SQL och separera kolumnerna. Om två olika tabeller har samma kolumnnamn så skriver värdena över varandra.
    2. Hämta ut adresserna separat med ett eget query och sedan para ihop dom med respektive kund. Eftersom kunderna har customer_id så kan man matcha ihop. Array_filter för att filtrera ut rätt adress
    3. Hämta ut varje adress för sig när du loopar igenm kunderna. Göre n select på costumer_id.




## Övning 2
Bygg vidare så att man kan hämta ut en kund i taget.
Genom att ange en GET-parameter (förslagsvis customer_id) så skall man kunna få ut en enskild kund.
Exempel på url: http://wieg16-api.dev/customers.php?customer_id=1
Denna url skall då visa mig kunden med id 1 i json-format.

1. Uppdatera din SQL så att du gör en WHERE id = 1...



## Övning 3
Det kan vara så att man skriver ett customer_id som inte finns.
Skriv kod som hanterar att du inte får någon träff i databasen.
En http statuskod på 404 måste skickas och ett lämpligt meddelande i json skall skrivas ut.
Exempel {"message": "Customer not found"}

1. Ta reda på hur många rader du fick ut från databasen.
2. Om du fick 0 rader så skall du skriva ut ett felmeddelande.
3. felmeddelandet skrivs lättast ut genom json_encode(["message => "404 ERROR Customer not found")
4. Glöm ej skicka headers med funktionen header()


## Övning 4
Skriv kod för att enbart visa kundens adress.
Exempel på url: http://wieg16-api.dev/customers.php?customer_id=1&address=true
Då skall adressen för kunden med id 1 skrivas ut på skärmen i json-format.

1. Gör en if-sats för om $_GET['address' är satt och är = true

2.Hämta adress från databasen baserat på customer_id

3.skriv ut addressen på skärmen.

4. visa felmeddelande på adressen inte finns.


## Övning 5
Datan som du hämtat hem tidigare är lite dåligt strukturerad. Det har visat sig att vi har behov av att veta vilka kunder som tillhör samma företag.
Skapa en separat tabell för företagen (förslagsvis companies) och koppla ihop den tabellen med din customers-tabell.
Skriv sedan kod som går igenom datan och plockar ut företagsnamnen.
Företagsnamnen lagras sedan i den nya separata tabellen och kunder med detta företagsnamn skall få samma company_id.

1. Lägg till company_id i customers-tabellen. Eller vad du nu döpt tabellen till.
1.1 Gör en ny tabell för comanies som innehåller company_name och id. Id kan vara AI autoincrement.
2. Hämta ut alla customers så att du har dem i en lista.
3. Gör en tom lista för att lagra alla companies.
4. Loopa igenom dina kunder och samla på dig companies. $companies[] = $customer['customer_company'
5. När loope är klar så kör du array_unique på $companies. När di har en lista med alla företag
6. Loopa igenom $companies och stoppa dem i en $companies-tabellen.
7. Hämta ut företagen igen från databasen för att få ut dem i en lista med sina id.
8. I loopen så kan du uppdatera customers-tabellen genom att göra en UPDATE customers SET company_id = x WHERE customer_company = x



## Övning 6
Utöka din customers.php så att man kan hämta kunder baserat på company_id.
Om company_id anges så skall alla kunder med detta id visas.
Exempel på url: http://wieg16-api.dev/customers.php?company_id=1
Denna url skall då visa mig alla kunder med company_id 1 i json-format.

1. Samma princip som övning 2. Gör helt enkelt en ny WHERE baserat på company_id istället för customer_id. 
