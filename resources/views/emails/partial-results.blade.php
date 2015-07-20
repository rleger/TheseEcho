<h1 class="mtl">Résultats actuels !</h1>

<h3 class="panel-title">Quelques chiffres</h3>
</div>
<div class="table-responsive">
  <table class="table table-striped first-col-left">
    <thead>
      <tr>
        <th></th>
        <th>Nombre</th>
        <th>Pourcentage</th>
      </tr>
    </thead>
    <tr>
      <td>Nombre de réponses</td>
      <td>{{ $participants }}</td>
      <td>-</td>
    </tr>
    <tr>
      <td>Nombre de centres</td>
      <td>{{ $centres_participants->count() }}</td>
      <td>-</td>
    </tr>
    <tr>
      <td>Centres non participants</td>
      <td>{{ $centres_non_participants->count() }}</td>
      <td>-</td>
    </tr>
    <tr>
      <td>Pratique de l'échographie</td>
      <td>{{ $results->howMany('interet_echo', 'oui') }}</td>
      <td>{{ formatNumberTwoDigits($results->howMany('interet_echo', 'oui', 'percentage')) }}%</td>
    </tr>
  </table>
</div>

