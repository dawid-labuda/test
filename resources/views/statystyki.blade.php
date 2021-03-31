
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $stat->nazwa }} </div>
                @foreach($testujemy as $test)
                {{$test}} <br>
                @endforeach

                

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
<a href="/fanpage"><- Wróć do listy</a><br><br>
              
<form action="" method="get">
Od:
<input type="date" id="od-stat" name="od-stat"
       value="<?php if(isset($_GET['od-stat'])) echo $_GET['od-stat']; else echo "2021-01-01"; ?>"
       min="2020-10-10"><br>
       Do: 
       <input type="date" id="do-stat" name="do-stat"
       value="<?php if(isset($_GET['do-stat'])) echo $_GET['do-stat']; else echo "2021-01-10"; ?>"
       min="2020-10-10"><br><br>
    <input type="submit" value="zobacz" class="btn btn-primary" />
</form>


                    <?php

if (isset($_GET['od-stat'])&&isset($_GET['do-stat'])) {
  $data_od = strtotime('-1 days', strtotime($_GET['od-stat']));
  $data_do= strtotime('+1 days', strtotime($_GET['do-stat']));
}
else{
    $data_od = strtotime('-1 day',strtotime('01-01-2021'));
    $data_do= strtotime('+1 day',strtotime('10-01-2021'));
}
    

$fb = new \Facebook\Facebook([
  'app_id' => $app->app_id,
  'app_secret' => $app->app_secret,
  'default_graph_version' => 'v2.2',
]);



try {
    // Returns a `Facebook\FacebookResponse` object
    $ilosc_postow = $fb->get(
      $stat->fanpage_id.'?fields=published_posts.limit(1000).summary(total_count).since(1)',
      'EAAF0oWecoM0BAAvbB6Igz8OIPOBDutPW9trqAhbO5kSbwJu6s9qa6WjaNXWj0VT08qpZB9HZBkVlUbyV6FneFi6tH8DdB5zpoGkY9q67TuoxREy0ZCAHcgPcYcocAaazhh9qddDYIIgWazC12WZAQMdCt5uX59T4W8YWFfgPnwZDZD'
    );
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }
  $graphList = $ilosc_postow->getGraphNode()->asArray();

  //zliczanie ilości postów na fanpage
  echo "<br><b>Ilość postów:</b> ".count($graphList['published_posts'])."<br><br>";

  //Liczba fanów

  try {
    // Returns a `Facebook\FacebookResponse` object
    $liczba_fanow = $fb->get(
      $stat->fanpage_id.'/insights/page_fans?since='.$data_od.'&until='.$data_do,
      'EAAF0oWecoM0BAAvbB6Igz8OIPOBDutPW9trqAhbO5kSbwJu6s9qa6WjaNXWj0VT08qpZB9HZBkVlUbyV6FneFi6tH8DdB5zpoGkY9q67TuoxREy0ZCAHcgPcYcocAaazhh9qddDYIIgWazC12WZAQMdCt5uX59T4W8YWFfgPnwZDZD'
    );
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }
  $graphLista = $liczba_fanow->getGraphList()->asArray();


  $tablica =$graphLista[0]['values'];

  //aktualna liczba fanów
  $aktualni_fani=0;

  echo "Ilość fanów danego dnia: <br>";
  //wyświetlanie liczby fanów na fanpage danego dniaW
  foreach($tablica as $i)
  {
      echo date_format($i['end_time'], 'Y-m-d')." - <b>".$i['value']."</b><br>";
      $aktualni_fani=$i['value'];
  }
  
  echo "<br>Liczba aktualnych fanów: <b>".$aktualni_fani."</b><br><br>";

  //Zasięgi

  try {
    // Returns a `Facebook\FacebookResponse` object
    $zasiegi = $fb->get(
      '290605364912796/insights/page_posts_impressions_unique?since='.$data_od.'&until='.$data_do,
      'EAAF0oWecoM0BAAvbB6Igz8OIPOBDutPW9trqAhbO5kSbwJu6s9qa6WjaNXWj0VT08qpZB9HZBkVlUbyV6FneFi6tH8DdB5zpoGkY9q67TuoxREy0ZCAHcgPcYcocAaazhh9qddDYIIgWazC12WZAQMdCt5uX59T4W8YWFfgPnwZDZD'
    );
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }
  $graphListaa = $zasiegi->getGraphList()->asArray();


  $tablica =$graphListaa[0]['values'];
  //zlinacznie sumy wyświetlen postów na fp
  $suma=0;
  //wyświetlanie liczby wyświetleń fanpage danego dnia (jeśli danego dnia nie było wyświetleń to nie ma danych z tego dnia)
  echo "Zagięgi postów danego dnia:<br>";
  echo "<table>";
  foreach($tablica as $i)
  {
      echo "<tr><td>".date_format($i['end_time'], 'Y-m-d')."</td><td> - </td><td><b>".$i['value']."</b></td></tr>";
      $suma+=$i['value'];
  }
  echo "</table>";
  echo "<br>zagięg postów: <b>".$suma."</b>";

  echo "<hr/><br>Zasięg fanpage/Ilość fanów: <b>".number_format($suma/$aktualni_fani,3)."</b><br>";
  echo "Współczynnik 'D' * ilość postów: <b>".number_format(($suma/$aktualni_fani)*count($graphList['published_posts']),3)."</b><br>";
    ?>
        


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
