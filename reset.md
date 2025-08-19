**ნაბიჯი 1: ყველა ძველი მიგრაციის ფაილის წაშლა.**

Bash

```
rm migrations/*.php
```

**ნაბიჯი 2: მონაცემთა ბაზის სრული გასუფთავება.**

Bash

```
ddev exec php bin/console doctrine:database:drop --force
```

**ნაბიჯი 3: მონაცემთა ბაზის ხელახლა შექმნა.**

Bash

```
ddev exec php bin/console doctrine:database:create
```

**ნაბიჯი 4: ერთიანი, ახალი მიგრაციის ფაილის შექმნა.**

ეს შექმნის ერთ მიგრაციას, რომელიც ასახავს კოდის ამჟამინდელ, საბოლოო მდგომარეობას.

Bash

```
ddev exec php bin/console make:migration
```

**ნაბიჯი 5: ახალი მიგრაციის გაშვება.**

Bash

```
ddev exec php bin/console doctrine:migrations:migrate
```

- დაადასტურეთ `yes`-ით.

**ნაბიჯი 6: Fixture-ების ჩატვირთვა.**

Bash

```
ddev exec php bin/console doctrine:fixtures:load
```

- დაადასტურეთ `yes`-ით.
