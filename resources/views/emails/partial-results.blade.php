<h1 class="mtl">Résultats actuels !</h1>

<h3 class="panel-title">Quelques chiffres</h3>
</div>
<div class="table-responsive">
  <table class="table table-striped">
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
      <td>Pratique l'ALR</td>
      <td>{{ $results->howMany('pratique_ALR', 'oui') }}</td>
      <td>{{ formatNumberTwoDigits($results->howMany('pratique_ALR', 'oui', 'percentage')) }}%</td>
    </tr>
    <tr>
      <td>Pratique de l'ALR dans les FESF</td>
      <td>{{ $results->howMany('pratique_ALR_FESF', 'jamais', 'absolute', '<>') }}</td>
      <td>{{ formatNumberTwoDigits($results->howMany('pratique_ALR_FESF', 'jamais', 'percentage', '<>')) }}%</td>
    </tr>
  </table>
