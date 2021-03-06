@extends('layouts.master')

@section('title')
    Janine's Assignment 3 - Split the Check
@endsection

@push('head')
        <link href='/css/splitter.css' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
        <link href='https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css' rel='stylesheet' type='text/css' />
        <link href='https://cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.min.css' rel='stylesheet' type='text/css'>
@endpush


@section('content')
        <form method='GET' action='index.blade.php'>
            <div class='container'>

                <div class='row'>
                    <div class='three columns'>
                        <p></p>
                    </div>
                    <div class='six columns' id='page_title'>
                        <h2> Split the Check</h2>
                    </div>
                </div>

                <div class='row'>
                    <div class='six columns' id='amount_label'>
                        <label>Bill Amount: </label>
                        <p>Required*</p>
                    </div>
                    <div class='six columns'>
                        <input type='text' name='totalBill' autofocus value={{ $totalBill or 0 }}>
                    </div>
                </div>

                <div class='row'>
                    <div class='six columns' id='npeople_label'>
                        <label>Number of People:</label>
                        <p>Required*</p>
                    </div>
                    <div class='six columns'>
                        <input type='text' name='numPeople' value={{ $numPeople or 1 }}>
                    </div>
                </div>

                <div class='row'> 
                    <div class='six columns'>
                        <label for='tip'>Quality of Service:</label>
                    </div>
                    <div class='six columns' id='service_menu'>
                        <select name='tip' id='tip'>
                            <option value='poor'  <?php if ($tip == 'poor')  echo 'SELECTED' ;?> >Poor</option>
                            <option value='good'  <?php if ($tip == 'good')  echo 'SELECTED' ;?> >Good</option>
                            <option value='great' <?php if ($tip == 'great') echo 'SELECTED' ;?> >Great</option>
                       </select>
                    </div>
                </div>


                <div class='row'>
                    <div class='six columns'>
                        <label> Round Up:</label>
                    </div>
                    <div class='six columns' id='round_check'>
                        <input type='checkbox' name='roundUp' {{ $roundUp }} > &nbsp;Yes
                    </div>
                </div>

                <div class='row'>
                    <div class='six columns' id='calc_button'>
                        <input type='submit' value='calculate' name='act'>
                    </div>
                    <div class='six columns' id='reset_button'>
                        <input type='submit' value='reset' name='act'>
                    </div>
                </div>


            @if ((isset($_GET['act']) && ($_GET['act'] == 'calculate') && isset($ppBill) && !isset($errmsgs)))
                <div class='row'>
                    <div class='three columns'>
                        <p></p>
                    </div>
                    <div class='six columns' id='results'>
                        <h4>Each person pays ${{ $ppBill }} </h4>
                    </div>
                </div>

	    @elseif ((isset($_GET['act']) && ($_GET['act'] == 'calculate') && isset($errmsgs) && (count($errmsgs) > 0)))
                <div class='row'>
                    <div class='three columns'>
                        <p></p>
                    </div>
                    <div class='six columns' id='errors'>
                        <h5>Errors:</h5>
                        <ul>
                            @foreach ($errmsgs->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                 </div>
	    @endif

            </div>

        </form>
@endsection
