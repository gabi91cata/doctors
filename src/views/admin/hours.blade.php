<optgroup label="Ore">
    @for($i = strtotime('2018-01-01 06:00'); $i<=strtotime('2018-01-01 21:55:00'); $i+=60*60)
        <option @if($selected==date("H:i:s", $i)) selected @endif value="{{ date("H:i:s", $i) }}">{{ date("H:i", $i) }}</option>
    @endfor
</optgroup>
<optgroup label="Ore jumatate">
    @for($i = strtotime('2018-01-01 00:00'); $i<=strtotime('2018-01-01 23:55:00'); $i+=60*30)
        @if(date("i", $i) == "30")
            <option @if($selected==date("H:i:s", $i)) selected @endif value="{{ date("H:i:s", $i) }}">{{ date("H:i", $i) }}</option>
        @endif
    @endfor
</optgroup>
<optgroup label="Ore sfert">
    @for($i = strtotime('2018-01-01 00:00'); $i<=strtotime('2018-01-01 23:55:00'); $i+=60*15)
        @if(date("i", $i) != "30" && date("i", $i) != "00")
            <option @if($selected==date("H:i:s", $i)) selected @endif value="{{ date("H:i:s", $i) }}">{{ date("H:i", $i) }}</option>
        @endif
    @endfor
</optgroup>