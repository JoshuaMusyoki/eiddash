
<!DOCTYPE html>
<html>
<head>

    <style type="text/css">
        body {
            font-weight: 1px;
        }

        table {
            border-collapse: collapse;
            margin-bottom: .5em;
        }

        table, th, td {
            border: 1px solid black;
            border-style: solid;
            font-size: 8px;
        }

        h5 {
            margin-top: 6px;
            margin-bottom: 6px;
        }

        p {
            margin-top: 2px;
            font-size: 8px;
        }
        * {
            font-size: 8px;
        }
    </style>
</head>
<body>
@foreach($allocation->details as $detail)
    @php
        $testType = consumables;
        if ($detail->testtype == 1) {
            $testType = 'EID';
        } else {
            $testType = 'VL';
        }
    @endphp
    <table class="table" border="0" style="width: 100%; border:none;">
        <tr>
            <td colspan="7" align="center" style="border: none;">
                <img src="http://lab-2.test.nascop.org/img/naslogo.jpg" alt="NASCOP">
            </td>
        </tr>
        <tr>
            <td colspan="7" align="center" style="border: none;">
                <strong><h5 style="text-transform: uppercase;">{{ $detail->machine->machine ?? '' }} {{ $testType }} DISTRIBUTION REQUEST FORM</h5></strong>
            </td>
        </tr>
    </table>
    <br />
    <table class="table" border="1" style="width: 50%; border: 1px solid;">
        <tr>
            <td colspan="2">{{ $master_data['to']['name'] }}</td>
        </tr>
        <tr>
            <td colspan="2">{{ $master_data['to']['address'] }}</td>
        </tr>
        <tr>
            <td>{{ __('Contact Name 1') }}</td>
            <td>{{ $master_data['to']['contact_name_1'] }}</td>
        </tr>
        <tr>
            <td>{{ __('Tel Number:') }}</td>
            <td>{{ $master_data['to']['telephone_1'] }}</td>
        </tr>
        <tr>
            <td>{{ __('Contact Name 2:') }}</td>
            <td>{{ $master_data['to']['contact_name_2'] }}</td>
        </tr>
        <tr>
            <td>{{ __('Tel Number') }}</td>
            <td>{{ $master_data['to']['telephone_2'] }}</td>
        </tr>
    </table>
    <table class="table" border="1" style="width: 40%; border: 1px solid;">
        <tr>
            <td colspan="2">{{ __('FROM') }}</td>
        </tr>
        <tr>
            <td colspan="2">{{ $master_data['to']['address'] }}</td>
        </tr>
        <tr>
            <td>{{ __('Contact Name 1') }}</td>
            <td>{{ $master_data['from']['contact_name_1'] }}</td>
        </tr>
        <tr>
            <td>{{ __('Tel Number:') }}</td>
            <td>{{ $master_data['from']['telephone_1'] }}</td>
        </tr>
        <tr>
            <td>{{ __('Contact Name 2:') }}</td>
            <td>{{ $master_data['from']['contact_name_2'] }}</td>
        </tr>
        <tr>
            <td>{{ __('Tel Number') }}</td>
            <td>{{ $master_data['from']['telephone_2'] }}</td>
        </tr>
    </table>
    <br />
    <table class="table" border="1" style="width: 50%; border: 1px solid;">
        <tr>
            <td>{{ __('Order Date') }}</td>
            <td>{{ date('d-M-Y', strtotime($allocation->orderdate)) }}</td>
        </tr>
        <tr>
            <td>{{ __('Order No.') }}</td>
            <td>{{ $allocation->order_num }}</td>
        </tr>
    </table>
    <table class="table" border="1" style="width: 40%; border: 1px solid;">
        <tr>
            <td colspan="4">{{ __('Delivery Date') }}</td>
        </tr>
        <tr>
            <td>{{ __('From') }}</td>
            <td>{{ date('d-M-Y', strtotime($allocation->orderdate)) }}</td>
            <td>{{ __('To') }}</td>
            <td>{{ date('d-M-Y', strtotime($allocation->orderdate)) }}</td>
        </tr>
    </table>
    <br>
    <table class="table" border="1" style="border: 1px solid;">
        <thead>
            <tr>
                <td>No.</td>
                <td>Description of Goods</td>
                <td>Unit</td>
                <td>Product No</td>
                <td>Quantity</td>
                <td>TOTALS</td>    
            </tr>
        </thead>
        <tbody>
        @foreach($detail->breakdowns as $key => $allocation_breakdown)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $allocation_breakdown->breakdown->name }}</td>
                <td>{{ $allocation_breakdown->breakdown->unit ?? '' }}</td>
                <td>{{ '' }}</td>
                <td>{{ $allocation_breakdown->allocated }}</td>
                <td>{{ $allocation_breakdown->allocated }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @php
        //die();
        //dd($detail);
    @endphp
@endforeach
        
        {{-- 
        @if(!$download)
        @forelse($data->performance as $performance)
            <table style="width: 100%;">
                <tbody>
                    <tr>
                        <th colspan="7">
                        @if($performance->testtype == 1)
                            EID
                        @else
                            VL - (@if($performance->sampletype == 1) Plasma @else DBS @endif)
                        @endif
                        </th>
                    </tr>
                    <tr>
                        <th>Period</th>
                        <th>#Received Samples</th>
                        <th>#Rejected Samples</th>
                        <th># Logged in System</th>
                        <th># NOT Logged in System</th>
                        <th># Tested</th>
                        <th>Reasons for Backlog</th>
                    </tr>
                    <tr>
                        <th>
                            <center>{{ date("F", mktime(null, null, null, $performance->month)) }}, {{ $performance->year }}</center>
                        </th>
                        <td>
                            <center>{{ $performance->received }}</center>
                        </td>
                        <td>
                            <center>{{ $performance->rejected }}</center>
                        </td>
                        <td>
                            <center>{{ $performance->loggedin }}</center>
                        </td>
                        <td>
                            <center>{{ $performance->notlogged }}</center>
                        </td>
                        <td>
                            <center>
                            @if($performance->testtype == 1)
                                {{ $data->eidcount }}
                            @elseif($performance->testtype == 2)
                                @if($performance->sampletype == 1)
                                    {{ $data->vlplasmacount }}
                                @else 
                                    {{ $data->vldbscount }}
                                @endif
                            @endif
                            </center>
                        </td>
                        <td>
                            <center>{{ $performance->reasonforbacklog }}</center>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <strong>Rejected Reasons: </strong><br>
                        @if($performance->testtype == 1)
                            @foreach($data->eidrejected as $key => $rejected)
                                {{ $rejected->name }}&nbsp;;&nbsp;
                            @endforeach
                        @elseif($performance->testtype == 2)
                            @if($performance->sampletype == 1)
                                @foreach($data->vlplasmarejected as $key => $rejected)
                                    {{ $rejected->name }}&nbsp;;&nbsp;
                                @endforeach
                            @else 
                                @foreach($data->vldbsrejected as $key => $rejected)
                                    {{ $rejected->name }}&nbsp;;&nbsp;
                                @endforeach
                            @endif
                        @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        @empty
            <tr><td colspan="7"><center>No Data Available</center></td></tr>
        @endforelse
        <br />
        @endif
        <table style="width: 100%;">
            <tbody>
                <tr>
                    <th colspan="10" align="center">EQUIPMENT LOG</th>
                </tr>
                 <tr>
                    <th>#</th>
                    <th>Equipment</th>
                    <th>Date of breakdown</th>
                    <th>Date Reported</th>
                    <th>Date Fixed</th>
                    <th>Downtime (Days)</th>
                    <th># of samples Not Run</th>
                    <th># of failed Runs</th>
                    <th># of reagents wasted</th>
                    <th>Breakdown Reason</th>
                </tr>
            @forelse($data->equipments as $key => $equipment)
                <tr>
                    <td><center>{{ $key+1 }}</center></td>
                    <td><center>{{ $equipment->equipment->name ?? '' }}</center></td>
                    <td><center>@isset($equipment->datebrokendown){{ date('d M, Y', strtotime($equipment->datebrokendown)) }} @endisset</center></td>
                    <td><center>@isset($equipment->datereported){{ date('d M, Y', strtotime($equipment->datereported)) }} @endisset</center></td>
                    <td><center>@isset($equipment->datefixed){{ date('d M, Y', strtotime($equipment->datefixed)) }} @endisset</center></td>
                    <td><center>{{ $equipment->downtime ?? '' }}</center></td>
                    <td><center>{{ $equipment->samplesnorun ?? '' }}</center></td>
                    <td><center>{{ $equipment->failedruns ?? '' }}</center></td>
                    <td><center>{{ $equipment->reagentswasted ?? '' }}</center></td>
                    <td><center>{{ $equipment->breakdownreason ?? '' }}</center></td>
                </tr>
            @empty
                <tr><td colspan="10"><center>No Data Available</center></td></tr>
            @endforelse
            </tbody>
        </table>
        --}}
</body>
</html>

