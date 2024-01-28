<!-- arrayDemo.php -->
<html>
  <head>
    <title>Array Demo Results</title>
  </head>
  <body>
    <?php
      // Function to receive form data
      function getFormValues() {
          // Retrieve form values using $_POST or $_GET
          // Replace this with your specific form field names
          return array(
              'rows' => $_POST['rows'],
              'columns' => $_POST['columns'],
              'min_value' => $_POST['min_value'],
              'max_value' => $_POST['max_value'],
          );
      }

      // Function to create and populate a 2D array
      function createArray($values) {
          // Implement logic to create and populate the array
          // Use $values['rows'], $values['columns'], $values['min_value'], and $values['max_value']
          // Replace the following example with your actual logic
          $array = array();
          for ($i = 0; $i < $values['rows']; $i++) {
              $array[$i] = array();
              for ($j = 0; $j < $values['columns']; $j++) {
                  $array[$i][$j] = rand($values['min_value'], $values['max_value']);
              }
          }
          return $array;
      }

      // Function to display the array in a table
      function printArrayTable($array) {
          echo "<table border='1'>";
          foreach ($array as $row) {
              echo "<tr>";
              foreach ($row as $value) {
                  echo "<td>{$value}</td>";
              }
              echo "</tr>";
          }
          echo "</table>";
      }

      // Function to calculate and display sum, average, and standard deviation
      function printCalculatedValues($array) {
          echo "<table border='1'>";
          echo "<tr><th>Sum</th><th>Average</th><th>Standard Deviation</th></tr>";

          foreach ($array as $row) {
              // Calculate sum, average, and standard deviation
              $sum = array_sum($row);
              $average = number_format(array_sum($row) / count($row), 3);
              $stdDev = number_format(calculateStandardDeviation($row), 3);

              // Display the results in the table
              echo "<tr><td>{$sum}</td><td>{$average}</td><td>{$stdDev}</td></tr>";
          }

          echo "</table>";
      }

      // Function to calculate standard deviation
      function calculateStandardDeviation($data) {
          $mean = array_sum($data) / count($data);
          $squaredDifferences = array_map(function ($x) use ($mean) {
              return pow($x - $mean, 2);
          }, $data);

          $variance = array_sum($squaredDifferences) / count($data);
          $stdDev = sqrt($variance);

          return $stdDev;
      }

      // Function to classify values as positive, negative, or zero
      function printClassifications($array) {
        echo "<table border='1'>";
        foreach ($array as $row) {
            echo "<tr>";
            foreach ($row as $value) {
                $classification = ($value > 0) ? 'positive' : (($value < 0) ? 'negative' : 'zero');
                echo "<td>{$value}</td>";
            }
            echo "</tr>";
            echo "<tr>";
            foreach ($row as $value) {
                $classification = ($value > 0) ? 'positive' : (($value < 0) ? 'negative' : 'zero');
                echo "<td>{$classification}</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

      // Main execution

           // Retrieve form values
           $formValues = getFormValues();

           // Create and populate 2D array
           $array_1 = createArray($formValues);
     
           // Display original array
           echo "<h2>Original Array</h2>";
           printArrayTable($array_1);
     
           // Display calculated values
           echo "<h2>Calculated Values</h2>";
           printCalculatedValues($array_1);
     
           // Display classification of values
           echo "<h2>Classification of Values</h2>";
           printClassifications($array_1);
     
           // Link back to arrayDemo.html
           echo "<br><a href='arrayDemo.html'>Go back to form</a>";
     
           // Save dynamically generated HTML to a file (optional)
           $outputHtml = ob_get_contents();
           file_put_contents("generated_output.html", $outputHtml);
         ?>
       </body>
     </html>
