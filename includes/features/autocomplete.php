  <script>
  $( function() {
    var availableTags = [
      "Hamburg",
      "Berlin",
      "München",
      "Köln",
      "Frankfurt (Main)",
      "Stuttgart",
      "Düsseldorf",
      "Dortmund",
      "Essen",
      "Leipzig",
      "Bremen",
      "Dresden",
      "Hannover",
      "Nürnberg",
      "Duisburg",
      "Bochum",
      "Wuppertal",
      "Bielefeld",
      "Bonn",
      "Münster",
      "Karlsruhe",
      "Mannheim",
      "Augsburg",
      "Wiesbaden",
      "Mönchengladbach",
      "Gelsenkirchen",
      "Braunschweig",
      "Kiel",
      "Chemnitz",
      "Aachen"
    ];
    $( "#tags" ).autocomplete({
      source: availableTags
    });
  } );
  </script>