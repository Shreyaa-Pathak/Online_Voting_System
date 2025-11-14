<?php

namespace App\Helpers;

class Sha256
{
    private static $k = [
        0x428a2f98, 0x71374491, 0xb5c0fbcf, 0xe9b5dba5, 0x3956c25b, 0x59f111f1, 0x923f82a4, 0xab1c5ed5,
        0xd807aa98, 0x12835b01, 0x243185be, 0x550c7dc3, 0x72be5d74, 0x80deb1fe, 0x9bdc06a7, 0xc19bf174,
        0xe49b69c1, 0xefbe4786, 0x0fc19dc6, 0x240ca1cc, 0x2de92c6f, 0x4a7484aa, 0x5cb0a9dc, 0x76f988da,
        0x983e5152, 0xa831c66d, 0xb00327c8, 0xbf597fc7, 0xc6e00bf3, 0xd5a79147, 0x06ca6351, 0x14292967,
        0x27b70a85, 0x2e1b2138, 0x4d2c6dfc, 0x53380d13, 0x650a7354, 0x766a0abb, 0x81c2c92e, 0x92722c85,
        0xa2bfe8a1, 0xa81a664b, 0xc24b8b70, 0xc76c51a3, 0xd192e819, 0xd6990624, 0xf40e3585, 0x106aa070,
        0x19a4c116, 0x1e376c08, 0x2748774c, 0x34b0bcb5, 0x391c0cb3, 0x4ed8aa4a, 0x5b9cca4f, 0x682e6ff3,
        0x748f82ee, 0x78a5636f, 0x84c87814, 0x8cc70208, 0x90befffa, 0xa4506ceb, 0xbef9a3f7, 0xc67178f2,
    ];

    private static function rightRotate($a, $b)
    {
        return (($a >> $b) | ($a << (32 - $b))) & 0xffffffff;
    }

    public static function hash($msg)
    {
        $msg = unpack('C*', $msg);
        $l = count($msg) * 8;

        // Append the bit '1'
        $msg[] = 0x80;

        // Pad zeros until message length ≡ 448 mod 512
        while ((count($msg) * 8) % 512 != 448) {
            $msg[] = 0x00;
        }

        // Append length as 64-bit big-endian
        for ($i = 7; $i >= 0; $i--) {
            $msg[] = ($l >> ($i * 8)) & 0xff;
        }

        $h = [
            0x6a09e667,
            0xbb67ae85,
            0x3c6ef372,
            0xa54ff53a,
            0x510e527f,
            0x9b05688c,
            0x1f83d9ab,
            0x5be0cd19,
        ];

        for ($i = 1; $i <= count($msg); $i += 64) {

            $w = [];

            for ($j = 0; $j < 16; $j++) {
                $w[$j] =
                    ($msg[$i + ($j * 4)] << 24) |
                    ($msg[$i + ($j * 4) + 1] << 16) |
                    ($msg[$i + ($j * 4) + 2] << 8) |
                    ($msg[$i + ($j * 4) + 3]);
            }

            for ($j = 16; $j < 64; $j++) {
                $s0 = self::rightRotate($w[$j - 15], 7) ^ self::rightRotate($w[$j - 15], 18) ^ ($w[$j - 15] >> 3);
                $s1 = self::rightRotate($w[$j - 2], 17) ^ self::rightRotate($w[$j - 2], 19) ^ ($w[$j - 2] >> 10);
                $w[$j] = ($w[$j - 16] + $s0 + $w[$j - 7] + $s1) & 0xffffffff;
            }

            $a = $h[0]; $b = $h[1]; $c = $h[2]; $d = $h[3];
            $e = $h[4]; $f = $h[5]; $g = $h[6]; $h0 = $h[7];

            for ($j = 0; $j < 64; $j++) {
                $S1 = self::rightRotate($e, 6) ^ self::rightRotate($e, 11) ^ self::rightRotate($e, 25);
                $ch = ($e & $f) ^ ((~$e) & $g);
                $temp1 = ($h0 + $S1 + $ch + self::$k[$j] + $w[$j]) & 0xffffffff;

                $S0 = self::rightRotate($a, 2) ^ self::rightRotate($a, 13) ^ self::rightRotate($a, 22);
                $maj = ($a & $b) ^ ($a & $c) ^ ($b & $c);
                $temp2 = ($S0 + $maj) & 0xffffffff;

                $h0 = $g; $g = $f; $f = $e; $e = ($d + $temp1) & 0xffffffff;
                $d = $c; $c = $b; $b = $a; $a = ($temp1 + $temp2) & 0xffffffff;
            }

            $h[0] = ($h[0] + $a) & 0xffffffff;
            $h[1] = ($h[1] + $b) & 0xffffffff;
            $h[2] = ($h[2] + $c) & 0xffffffff;
            $h[3] = ($h[3] + $d) & 0xffffffff;
            $h[4] = ($h[4] + $e) & 0xffffffff;
            $h[5] = ($h[5] + $f) & 0xffffffff;
            $h[6] = ($h[6] + $g) & 0xffffffff;
            $h[7] = ($h[7] + $h0) & 0xffffffff;
        }

        return sprintf(
            '%08x%08x%08x%08x%08x%08x%08x%08x',
            $h[0], $h[1], $h[2], $h[3], $h[4], $h[5], $h[6], $h[7]
        );
    }
}
