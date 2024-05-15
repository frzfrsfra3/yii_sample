<?php
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Users';
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'username',
        'email',
        // Other columns...
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'id' => $model->id]);
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->id], [
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]);
                },
            ],
        ],
    ],
    'options' => ['id' => 'user-table'],
]); ?>
<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <!-- Add more columns as needed -->
    </tr>
  </thead>
  <tbody id="userTableBody">
    <!-- User data will be populated here -->
  </tbody>
</table>

<script>
  // Fetch user data from API endpoint
  axios.get('/api/users')
    .then(function (response) {
      // Handle success
      var userData = response.data;
      var userTableBody = document.getElementById('userTableBody');
      userData.forEach(function(user) {
        var row = '<tr>' +
                    '<td>' + user.id + '</td>' +
                    '<td>' + user.username + '</td>' +
                    '<td>' + user.email + '</td>' +
                    // Add more columns as needed
                  '</tr>';
        userTableBody.innerHTML += row;
      });
    })
    .catch(function (error) {
      // Handle error
      console.error('Error fetching user data:', error);
    });
</script>

<?php
$js = <<<JS
$(document).ready(function() {
    $('#user-table').DataTable();
});
JS;
$this->registerJs($js);
?>
