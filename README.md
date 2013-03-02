# Config Reader to parse ini files
[![Build Status](https://travis-ci.org/jayzeng/PHPEnum.png)](https://travis-ci.org/jayzeng/PHPEnum)

Project website: (http://jayzeng.github.com/PHPEnum/)

##Usage:
```php

class StubUtilEnum extends Enum
{
    const ONE   = 1;
    const TWO   = 2;
    const THREE = 3;
    const FOUR  = "four";
}


// Retrieve value mapped to the label
$StubUtilEnum->getValue('ONE');   // returns 1
$StubUtilEnum->getValue('FOUR');   // returns four
$StubUtilEnum->getValues();    //  array

// Determine if a label exists
$StubUtilEnum->hasLabel(1);         // true
$StubUtilEnum->hasLabel('oops');    // false

```

##Details
See https://github.com/jayzeng/PHPEnum/blob/master/Tests/Src/EnumTest.php

##Issues & Development
- Source hosted [GitHub](https://github.com/jayzeng/PHPEnum)
- Report issues, questions, feature requests on [GitHub Issues](https://github.com/jayzeng/PHPEnum/issues)

##How to release new version?
- RELEASE_VERSION - version number
- RELEASE_MESSAGE - release message

```bash
make release RELEASE_VERSION="0.1" RELEASE_MESSAGE="v0.1 is released"
```

##Author:
[Jay Zeng](https://github.com/jayzeng/), e-mail: [jayzeng@jay-zeng.com](mailto:jayzeng@jay-zeng.com)
