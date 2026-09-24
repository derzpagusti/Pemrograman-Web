# wireframe-additions.md

# Exercise 1 — Wireframe: "Register New Member" (Guest actor)
+--------------------------------------+
| SIMPUS-Mini                          |
|---------------------------------------|
|                                        |
| [ Register New Member ]               |
|                                        |
| Full Name  : [______________]         |
| Address    : [______________]         |
| Phone No.  : [______________]         |
| Email      : [______________]         |
|                                        |
| [ Register ]                          |
|                                        |
| Already a member? Back to Home        |
+--------------------------------------+

# Exercise 2 — User Flow: "Librarian searches for members with overdue loans"

[Librarian Login] -> [Dashboard] -> [Select "Members" menu]
  -> [Open Member Search] -> [Filter: overdue loans only]
  -> [View matching members list] -> [Select a member]
  -> [View that member's overdue titles] -> [Back to Dashboard]

## Exercise 3 — Additional edge cases

1. **Lending the same book to the same member twice in a row.** If a
   member already has an active (not yet returned) loan for a given title,
   that same title should not be offered again in the "Choose Book" step of
   the Borrowing flow, even if stock remains available. Without this check,
   the same physical copy could appear to be lent out twice at once in the
   records.
2. **A member trying to register with a phone number or email already used
   by an existing member.** Because `members/add.html` collects Phone No.
   and Email, duplicate contact details could otherwise create two 
   records for what is really one person. 
   This should be checked before a new member record is saved.

