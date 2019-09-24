<?php
namespace app\World\Object;

use app\Common\Srp6;
use app\World\OpCode;
use app\World\Packet\Packetmanager;
use app\World\WorldServer;

/**
 *
 */
class WorldObject
{
    public static function LoginObject($serv, $fd, $data = null)
    {
        WORLD_LOG('[SMSG_UPDATE_OBJECT] Client : ' . $fd, 'warning');
        $data = '010000000003037A03047100000000003216795D5C2FD1448FD2CF44CD8C0A435131B74000000000000020400000E04000009040711C9740000020400000E04000009040E00F49400000000031170040141D40000000000000000000000000C00300F80004000001000090010000000000000000000000000400040004000400040004000400040004000400040004000400040004000400040000000000FCFFFFFFFF0000000000000000000000000000000000000000000000000000000000C0BD000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000003001800000000000000000000000000000020001040000000800000000000407A03000000000000190000000000803F0C000000000000000C0000000000000001000000050000000504000300000000022BC73E0000C03F39000000390000000F0000000F0000000C0000000700000002000000000000000C00000000000000040900080E0000020000000000000000000000003908000000000000000000007800000079000000000000000000000000000000000000000000000000000000000000002C080000000000000000000000000000000000000000000000000000000000007C03003908000040000000000000000000000000000000007D030078000000407E0300790000004000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000007B03002C080000400000000000000000000000000000000000000000000000000000000000000000A10200002C010000DC0000002C010000010000000100000000000000000000000000000000000000102700000100000000000000FFFFFFFF46000000';

        $Srp6         = new Srp6();
        $data         = $Srp6->BigInteger($data, 16)->toBytes();
        $data         = GetBytes($data);
        $encodeheader = Packetmanager::Worldpacket_encrypter($fd, [OpCode::SMSG_UPDATE_OBJECT, $data, WorldServer::$clientparam[$fd]['sessionkey']]);
        $packdata     = array_merge($encodeheader, $data);

        return $packdata;
    }
}