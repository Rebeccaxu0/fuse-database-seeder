<?php

namespace Database\Seeders;

use App\Models\LTIPlatform;
use Illuminate\Database\Seeder;

class LTIPlatformSeeder extends Seeder
{
    private $default = [
        'domain' => 'evanston.cityoflearning.org',
        'client_id' => 'L3',
        'auth_login_url' => 'https://el-3.org/lti-auth',
        'auth_token_url' => 'https://evanston.col-engine.com/api/v1/lti_tool_providers/1/auth.json',
        'key_set_url' => 'https://el-3.org/packages/l3lti/assets/jwks.json',
        'private_key' => '-----BEGIN RSA PRIVATE KEY-----
MIIEowIBAAKCAQEAwr0PZwyyUA+LWi5dwwbd+E2BSjSexBYcvto0SUaTOhTadNU8
xEU6YVEL03o7Qq5zYr3jGFjVoMmT1XD4QYMxLcwRyqBiH8oxCqHBt11Rc8l4lPt0
FobSuOxwLEB44yxGR9hbram2Oeyd0MM1s2mblICFxTDb2XQhcS8opMPeGmKd72ue
c+jEl/eKEbsWlisJCpeHfp6/WPruTrdRu8TpJdQfcGSgKeLaxildwBiHAAZxoogS
hGAFuWKQ+70InJvojAC7lvJ3v2SSX6XXL5Aqfv5JxwoPA2qYsHz2+JkYz9RM1QdN
qnyl1VqtsRcFTB1upWR14yl9YRSvXSig0E4XPwIDAQABAoIBAQCDZ83/7GpaadLP
vJ/aXUTlK2+F4jIMARvOkTFdDLmGJNIwqj9B9bDqQCUpw74/RbZot9eI81DcGYmf
Kobqths2WxDaWRU9fFNRaEtubxLqfdXXOkJgfQOucyVSRwML0DFwg4eBjRaAybDI
USFoemfYck1R/aEsgBec54SWgfDafemUp70CqI0/mlkd8nRQI1qrDmYZF+ykJfFU
JJBItpedN3yKhqd6dES+abxvYnuumU6jMW1QMnprarfmI+tBZ6cYHQ9LmvFYU5Nb
y+PXB4HHOxCp1vu4YAjeZVcYhzgckoRI5WAsvC2DUIFMBohxSctyN05eYBx1WAkc
v4bI6x2hAoGBAOk6VLVCm+hzG6mp4LTrYQC9i8xnr7p3Qk9LLG9U4PghHMbTdwor
0O310WanH6oqsa8mrdAFiIeas0siSIzu0Mub0AaUE5kpJaKUipljK5/FD5ZIRE9n
ApqnS92n+F5mkBdH8YKCtfXr6EaTDoPMdKpk7jn7/KYPNWd5YxMldWuPAoGBANXA
qlNi+JYk9yZCB/7/qU2tiKunV443P3mrZXxpmDFMgMgrcsCe8YSZYa4GN3xm/XH5
uBFilm8fH7I2K5CHRmUnyREqbh7XbEJl5JFg0REC+J44xSA2jY4B+kmK5YHrSTek
7+e6fIxKUTkw/KRNXsT1Pjk6/TGv0n8U8bgbzIFRAoGAI6pd5dIn0WY45rspt8D+
9oQF6t44S0WNiF6wjt3mAUvfALC51X5Z1unueco412bsASLjFZqjBEmt/WFiwtqK
Z3iOWVMvpA5cyP36K/a0ZxxVg9/NQm84QLowqdbT7mu0wTqpPhILDW5j+NboM1OC
y8PfglJ8klBlFEvF0Nm7mRUCgYB6AUl25RPcp2bGWIQ14XmiU72htJd+HjzF1rXL
iH4NDYyoNFyAY3iZZe7iJLxA7owVJSMSEUKqVIqD7vV4vi3JCSdz+9L1GaK6V2xa
KnfKjPaZYO/rThgICUrx9SzAtiqJb0Rb8Q6sCLNJwJNDuMGyDAUjJ29jj+bHEI5T
ttJIsQKBgBSmY+rryID4/qbEIK6DtjsRMC+Sl/lMOQ8PUJENafK2NRIiUEE/xntc
Fh50gTfxGf7Iu7XawZBT4ZcoQEwHp/fA316OcGttPC1MbKS+6XsUSJs+7Oxqyx7J
PpAk3PxwT9zS4QTed8yrvfxwVbFDYGG1y6bQZDtGfvWqlA3GTyEZ
-----END RSA PRIVATE KEY-----',
        'deployment_json' => '{"1234": "1234"}',
        'line_items_url' => 'https://evanston.col-engine.com/api/v1/lti_line_items',
        'scope_urls' => '["https://purl.imsglobal.org/spec/lti-ags/scope/lineitem", "https://purl.imsglobal.org/spec/lti-ags/scope/result.readonly", "https://purl.imsglobal.org/spec/lti-ags/scope/score"]',
        'api_token' => '4e5b0bded0eb9f845ce60d0cea5ab844c41814f3dcd7ed5026e7744c253e25e0',
        'api_secret' => '79ae713b-6d0d-422b-976d-a2375dd0565b',
        'api_endpoint' => 'https://evanston.col-engine.com/partner_api/v1/campaigns/fuse_users/campaign_users/invite.json',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = LTIPlatform::factory();
        $role->create($this->default);
    }
}
