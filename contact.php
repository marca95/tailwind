<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <link rel="icon" type="image/svg+xml" href="/vite.svg" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="src/style.css">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <title>Formulaire de contact</title>
</head>

<body class="flex items-center justify-center min-h-screen bg-sky-900">
  <div class="w-full max-w-lg p-8 bg-slate-400 rounded-lg shadow-lg">
    <form id="contact_form" method="POST">
      <div class="space-x-6">
        <div class="border-b border-gray-900/10 pb-12">
          <h1 class="text-4xl mb-20 text-center">Formulaire de contact</h1>
          <h2 class="text-base font-semibold leading-7 text-gray-900">Données personnelles</h2>
          <p class="mt-1 text-sm leading-6 text-gray-700">Vos données resteront anonymes</p>

          <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3">
              <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Prénom</label>
              <div class="mt-2">
                <input type="text" name="first-name" id="first-name" autocomplete="given-name" required class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
            </div>

            <div class="sm:col-span-3">
              <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Nom de famille</label>
              <div class="mt-2">
                <input type="text" name="last-name" id="last-name" autocomplete="family-name" required class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
            </div>

            <div class="sm:col-span-4">
              <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Adresse e-mail</label>
              <div class="mt-2">
                <input id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
            </div>

            <div class="sm:col-span-3">
              <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Pays</label>
              <div class="mt-2">
                <select id="country" name="country" autocomplete="country-name" required class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                  <option value="1">Etat-Unis</option>
                  <option value="2">Belgique</option>
                  <option value="3">France</option>
                  <option value="4">Allemagne</option>
                </select>
              </div>
            </div>
            <div class="col-span-full">
              <label for="about" class="block text-sm font-medium leading-6 text-gray-900">A propos</label>
              <div class="mt-2">
                <textarea id="about" name="about" rows="3" required class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
              </div>
            </div>
          </div>
          <br />
          <div class="g-recaptcha" data-sitekey="6LecaxsqAAAAAK7TYYY8dRlY4ritNp9l4nzETcJo"></div>
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        </div>
      </div>
      <p id="response" class="block w-full"></p>
      <div class="mt-6 flex items-center justify-end gap-x-6">
        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Envoyer</button>
      </div>
    </form>
  </div>
  <script>
    // Traitement de données du formulaire

    let form = document.getElementById('contact_form');
    form.addEventListener('submit', (e) => {
      // e.preventDefault();

      const firstName = document.getElementById('first-name').value.trim();
      const name = document.getElementById('last-name').value.trim();
      const email = document.getElementById('email').value.trim();
      const country = document.getElementById('country').value.trim();
      const about = document.getElementById('about').value.trim();
      let response = document.getElementById('response');

      const maxNbr = 255;
      const regex = /^[\p{L}\p{M} ]+$/;
      const regexEmail = /^[a-zA-Z0-9.%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

      if (firstName == "") {
        response.innerHTML = "Vous devez avoir un prénom";
        e.preventDefault();
      } else if (firstName.length > maxNbr) {
        response.innerHTML = "Votre prénom est trop long";
        e.preventDefault();
      } else if (!regex.test(firstName)) {
        response.innerHTML = "Votre prénom contient des caractères non désiré";
        e.preventDefault();
      }

      if (name == "") {
        response.innerHTML = "Vous devez avoir un nom";
        e.preventDefault();
      } else if (name.length > maxNbr) {
        response.innerHTML = "Votre nom est trop long";
        e.preventDefault();
      } else if (!regex.test(name)) {
        response.innerHTML = "Votre nom contient des caractères non désiré";
        e.preventDefault();
      }
    });

    if (email == "") {
      response.innerHTML = "Vous devez avoir une adresse e-mail";
      e.preventDefault();
    } else if (email.length > maxNbr) {
      response.innerHTML = "Votre adresse e-mail est trop longue";
      e.preventDefault();
    } else if (!regexEmail.test(email)) {
      response.innerHTML = "Votre adresse e-mail contient des caractères non désiré";
      e.preventDefault();
    }

    // Création de ma requete asynchrone 

    document.getElementById('contact_form').addEventListener('submit', async function(e) {
      e.preventDefault();

      const formData = new FormData(e.target);
      const formJSON = Object.fromEntries(formData.entries());

      try {
        const response = await fetch('./formulaire.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(formJSON)
        });

        const result = await response.json();
        document.getElementById('response').textContent = 'Formulaire envoyé avec succès!';
      } catch (error) {
        document.getElementById('response').textContent = 'Erreur lors de l\'envoi du formulaire.';
      }
    });
  </script>
</body>

</html>