<?php

namespace App\Util;

class StudioCode
{
    private const ADJECTIVES = [
        'able',
        'best',
        'blue',
        'busy',
        'calm',
        'clear',
        'cool',
        'cute',
        'easy',
        'fast',
        'first',
        'flat',
        'free',
        'full',
        'fun',
        'good',
        'gray',
        'happy',
        'huge',
        'long',
        'loud',
        'neat',
        'new',
        'nice',
        'quick',
        'slow',
        'smart',
        'soft',
        'solar',
        'tall',
        'tiny',
        'vast',
        'warm',
        'wide',
    ];

    private const NOUNS = [
        'angle',
        'app',
        'app',
        'camera',
        'car',
        'cell',
        'chip',
        'coaster',
        'code',
        'design',
        'device',
        'fun',
        'game',
        'game',
        'goal',
        'house',
        'laser',
        'level',
        'light',
        'link',
        'music',
        'phone',
        'printer',
        'program',
        'robot',
        'screen',
        'skill',
        'switch',
        'tech',
        'try',
        'video',
        'wire',
    ];

    private const VERBS = [
        'accept',
        'add',
        'admire',
        'admit',
        'advise',
        'afford',
        'agree',
        'alert',
        'allow',
        'amuse',
        'annoy',
        'answer',
        'appear',
        'argue',
        'arrive',
        'ask',
        'attach',
        'attend',
        'avoid',
        'back',
        'ban',
        'bat',
        'beam',
        'behave',
        'belong',
        'blink',
        'blot',
        'bolt',
        'book',
        'bore',
        'borrow',
        'bow',
        'brake',
        'branch',
        'brush',
        'bubble',
        'bump',
        'burn',
        'bury',
        'buzz',
        'call',
        'camp',
        'care',
        'carry',
        'cause',
        'change',
        'charge',
        'chase',
        'check',
        'cheer',
        'chew',
        'claim',
        'clean',
        'clear',
        'clip',
        'close',
        'coach',
        'coil',
        'colour',
        'comb',
        'copy',
        'cough',
        'count',
        'cover',
        'crash',
        'crawl',
        'cross',
        'cure',
        'curl',
        'curve',
        'cycle',
        'dam',
        'damage',
        'dance',
        'dare',
        'decay',
        'decide',
        'delay',
        'depend',
        'desert',
        'detect',
        'divide',
        'double',
        'drain',
        'dream',
        'dress',
        'drip',
        'drop',
        'drum',
        'dry',
        'dust',
        'earn',
        'employ',
        'end',
        'enjoy',
        'escape',
        'excuse',
        'exist',
        'expand',
        'expect',
        'face',
        'fade',
        'fancy',
        'fasten',
        'fax',
        'fence',
        'fetch',
        'file',
        'film',
        'fire',
        'fit',
        'fix',
        'flap',
        'float',
        'flood',
        'flow',
        'flower',
        'fold',
        'follow',
        'form',
        'found',
        'frame',
        'fry',
        'gather',
        'glow',
        'glue',
        'grate',
        'greet',
        'grin',
        'guard',
        'guess',
        'guide',
        'hand',
        'handle',
        'happen',
        'heal',
        'heap',
        'heat',
        'help',
        'hook',
        'hop',
        'hope',
        'hover',
        'hug',
        'hum',
        'hunt',
        'hurry',
        'ignore',
        'inform',
        'intend',
        'invent',
        'invite',
        'itch',
        'jog',
        'join',
        'joke',
        'judge',
        'juggle',
        'jump',
        'kick',
        'knit',
        'knock',
        'knot',
        'label',
        'land',
        'last',
        'laugh',
        'launch',
        'learn',
        'level',
        'like',
        'list',
        'listen',
        'live',
        'lock',
        'look',
        'manage',
        'march',
        'mark',
        'match',
        'matter',
        'meddle',
        'mend',
        'mine',
        'miss',
        'mix',
        'moor',
        'move',
        'muddle',
        'mug',
        'nail',
        'name',
        'need',
        'nest',
        'nod',
        'note',
        'notice',
        'number',
        'obtain',
        'occur',
        'offer',
        'open',
        'order',
        'pack',
        'paddle',
        'paint',
        'park',
        'part',
        'paste',
        'pat',
        'pause',
        'pedal',
        'peel',
        'peep',
        'permit',
        'phone',
        'pick',
        'pine',
        'place',
        'plan',
        'plant',
        'play',
        'point',
        'poke',
        'polish',
        'pop',
        'post',
        'pour',
        'prefer',
        'press',
        'print',
        'pull',
        'push',
        'queue',
        'race',
        'rain',
        'raise',
        'reach',
        'record',
        'reduce',
        'refuse',
        'reign',
        'relax',
        'rely',
        'remain',
        'remind',
        'remove',
        'repair',
        'repeat',
        'reply',
        'report',
        'rescue',
        'retire',
        'return',
        'rhyme',
        'rinse',
        'risk',
        'rob',
        'rock',
        'roll',
        'rush',
        'sail',
        'save',
        'scrape',
        'seal',
        'shade',
        'share',
        'shiver',
        'shock',
        'shop',
        'shrug',
        'sigh',
        'sign',
        'signal',
        'sip',
        'ski',
        'skip',
        'slip',
        'slow',
        'smell',
        'smile',
        'sneeze',
        'sniff',
        'snore',
        'snow',
        'soothe',
        'sound',
        'spare',
        'spark',
        'spell',
        'spill',
        'spoil',
        'spot',
        'spray',
        'sprout',
        'squash',
        'stamp',
        'start',
        'stay',
        'steer',
        'step',
        'stir',
        'stitch',
        'stop',
        'store',
        'stuff',
        'suit',
        'supply',
        'switch',
        'talk',
        'tame',
        'test',
        'thank',
        'thaw',
        'tick',
        'tie',
        'time',
        'tip',
        'tire',
        'tour',
        'tow',
        'trace',
        'trade',
        'train',
        'trap',
        'travel',
        'treat',
        'trick',
        'trip',
        'trot',
        'trust',
        'try',
        'tumble',
        'turn',
        'twist',
        'type',
        'unite',
        'unlock',
        'unpack',
        'untidy',
        'use',
        'vanish',
        'visit',
        'wait',
        'walk',
        'wander',
        'want',
        'warm',
        'warn',
        'wash',
        'watch',
        'water',
        'wave',
        'weigh',
        'whine',
        'whip',
        'whirl',
        'wink',
        'wipe',
        'wish',
        'wobble',
        'wonder',
        'work',
        'wrap',
        'wreck',
        'x-ray',
        'yell',
        'zip',
    ];


    public static function generate()
    {
        $adjective = self::ADJECTIVES[array_rand(self::ADJECTIVES)];
        $noun = self::NOUNS[array_rand(self::NOUNS)];
        $num = sprintf("%'.03u", mt_rand(0, 999));
        return "{$adjective} {$noun} {$num}";
    }
}

