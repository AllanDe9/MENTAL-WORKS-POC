<?php
   /**
     * @param array $errors
     * @param string $field
     * @return array
     */

     function addMessageIfValueIsEmpty(array $errors, string $field): array
     {
         if (empty($_POST[$field])) {
             $errors[$field][] = sprintf('This field must be completed', $field);
         }
 
         return $errors;
     }
     function addMessageIfBoxIsUnchecked(array $errors, string $field): array
     {
         if (empty($_POST[$field])) {
             $errors[$field][] = sprintf('This box must be checked', $field);
         }
 
         return $errors;
     }
 
     function displayErrors(array $errors, string $field): void
     {
 
         if (isset($errors[$field])) {
             foreach ($errors[$field] as $error) {
                 echo '<p class="error">' . $error . '</p>';
             }
         }
     }


    $errors = [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_POST) === false) {

        $errors = addMessageIfValueIsEmpty($errors, 'last-name');
        $errors = addMessageIfValueIsEmpty($errors, 'first-name');
        $errors = addMessageIfValueIsEmpty($errors, 'email');
        $errors = addMessageIfValueIsEmpty($errors, 'profession');
        $errors = addMessageIfBoxIsUnchecked($errors, 'policy');

        if (!empty($_POST['email'])) {
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            	$errors['email'][] = 'Email is invalid';
            }
        }
        
        
        

        if (empty($errors)) {
        	$information = [
        		'last-name' => htmlspecialchars($_POST['last-name']),
            'first-name' => htmlspecialchars($_POST['first-name']),
            'email' => htmlspecialchars($_POST['email']),
            'profession' => htmlspecialchars($_POST['profession']),
        	];
          
        }
        if (!empty($_POST['machine-learning'])){
          $information['machine-learning'] = 'Machine-learning';
        };
        if (!empty($_POST['product-design'])){
          $information['product-design'] = 'Product Design';
        };
        if (!empty($_POST['web-development'])){
          $information['web-development'] = 'Web Development';
        };
        if (!empty($_POST['crypto'])){
          $information['crypto'] = 'Crypto';
        };
    }
    
    $curl = curl_init();
    $params=['id' => '1'];

    curl_setopt($curl, CURLOPT_URL, "http://51.91.108.32/registrations");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $params);

    $result = curl_exec($curl);
    curl_close($curl);

    echo $result;

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <script src="https://cdn.tailwindcss.com"></script>
     <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#000',
            'primary-foreground': '#FFF',
          }
        }
      }
    }
  </script>
  <title>Subscribe to your newsletter</title>
</head>
<body>
<div class="mx-auto max-w-2xl space-y-8">
  <div class="space-y-2 !mt-8">
    <h1 class="text-3xl font-bold">Subscribe to your newsletter</h1>
    <p class="text-gray-500 dark:text-gray-400">Enter your information to get in touch</p>
  </div>
  <form class="space-y-4" method="POST">
    <div class="grid grid-cols-2 gap-4">
      <div class="space-y-2">
        <label
          class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
          for="first-name"
        >
          First name<span class="text-red-500">*</span>
        </label>
        <input
          class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
          id="first-name"
          name="first-name"
          placeholder="Enter your first name"
          required=""
        />
        <?php displayErrors($errors, 'first-name'); ?>
      </div>
      <div class="space-y-2">
        <label
          class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
          for="last-name"
        >
          Last name<span class="text-red-500">*</span>
        </label>
        <input
          class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
          id="last-name"
          name="last-name"
          placeholder="Enter your last name"
          required=""
        />
        <?php displayErrors($errors, 'last-name'); ?>
      </div>
    </div>
    <div class="space-y-2">
      <label
        class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
        for="email"
      >
        Email<span class="text-red-500">*</span>
      </label>
      <input
        class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
        id="email"
        name="email"
        placeholder="Enter your email"
        required=""
        type="email"
      />
      <?php displayErrors($errors, 'email'); ?>
    </div>
    <div class="space-y-2">
      <label
        class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
        for="profession"
      >
        Profession<span class="text-red-500">*</span>
      </label>
      <input
        class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
        id="profession"
        name="profession"
        placeholder="Enter your profession"
        required=""
      />
    </div>
    <div class="space-y-2">
      <span class="block text-sm font-medium text-gray-900 dark:text-gray-100">Interests</span>
      <div class="grid grid-cols-2 gap-4">
        <div class="flex items-center space-x-2">
          <input
            type="checkbox"
            value="Machine Learning"
            class="peer h-4 w-4 shrink-0 rounded-sm border border-primary ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 data-[state=checked]:bg-primary data-[state=checked]:text-primary-foreground"
            id="machine-learning"
            name="machine-learning"
          />
          <?php displayErrors($errors, 'profession'); ?>
          <label
            class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium"
            for="machine-learning"
          >
            Machine Learning
          </label>
        </div>
        <div class="flex items-center space-x-2">
          <input
            type="checkbox"
            role="checkbox"
            value="Product Design"
            class="peer h-4 w-4 shrink-0 rounded-sm border border-primary ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 data-[state=checked]:bg-primary data-[state=checked]:text-primary-foreground"
            id="product-design"
            name="product-design"
          />
          <label
            class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium"
            for="product-design"
          >
            Product Design
          </label>
        </div>
        <div class="flex items-center space-x-2">
          <input
            type="checkbox"
            role="checkbox"
            value="Web Development"
            class="peer h-4 w-4 shrink-0 rounded-sm border border-primary ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 data-[state=checked]:bg-primary data-[state=checked]:text-primary-foreground"
            id="web-development"
            name="web-development"
          />
          <label
            class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium"
            for="web-development"
          >
            Web Development
          </label>
        </div>
        <div class="flex items-center space-x-2">
          <input
            type="checkbox"
            value="Crypto"
            class="peer h-4 w-4 shrink-0 rounded-sm border border-primary ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 data-[state=checked]:bg-primary data-[state=checked]:text-primary-foreground"
            id="crypto"
            name="crypto"
          />
          <label class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium" for="crypto">
            Crypto
          </label>
        </div>
      </div>
    </div>
    <div class="space-y-2 !mt-8">
      <div class="flex items-center space-x-2">
        <input
          type="checkbox"
          value="policy"
          class="peer h-4 w-4 shrink-0 rounded-sm border border-primary ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 data-[state=checked]:bg-primary data-[state=checked]:text-primary-foreground"
          id="policy"
          name="policy"
        />
        <label class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium" for="policy">
          By subscribing to the newsletter, you confirm that you have read our policy on the protection of your
          personal data. You can unsubscribe at any time by clicking on the link at the bottom of the newsletter or
          by making a simple request.<span class="text-red-500">*</span>
        </label>
      </div>
    </div>
    <?php displayErrors($errors, 'policy'); ?>
    <button
      class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2"
      type="submit"
    >
      Submit
    </button>
    <?php 
      if (!empty($information)){
        echo '<p>You are subscribed to our newsletter</p';
      }
    ?>
  </div>
</div>

</body>
</html>