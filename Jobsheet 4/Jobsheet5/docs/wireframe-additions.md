# wireframe-additions.md

## Exercise 1 — Wireframe: "Register New Member" (Guest actor)

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

- `SIMPUS-Mini` on the top line becomes the usual `<header><h1>`, identical
  to every existing page.
- `Register New Member` is the section heading (`<h2>`), the same pattern as
  "Add Member" already built in jobsheet-01.
- Each `Label : [______________]` line becomes a `<label>` + `<input>` pair,
  exactly the pattern already used in `members/add.html`. No field is marked
  as required in the wireframe on purpose — the `required` attributes are a
  coding decision to be finalised in HTML, not something the sketch needs to
  settle.
- `[ Register ]` becomes `<button type="submit">Register</button>`.
- `Already a member? Back to Home` is a plain link back to `index.html`, the
  same idea as the "No account yet? Register here" line on the Login
  wireframe.

## Exercise 2 — User Flow: "Librarian searches for members with overdue loans"

[Librarian Login] -> [Dashboard] -> [Select "Members" menu]
  -> [Open Member Search] -> [Filter: overdue loans only]
  -> [View matching members list] -> [Select a member]
  -> [View that member's overdue titles] -> [Back to Dashboard]

1. **[Librarian Login] -> [Dashboard]**: as with every Librarian-only
   feature, the flow starts from a logged-in state
2. **[Select "Members" menu]**: the librarian opens the existing "Members"
   section of the navbar rather than a brand-new menu item.
3. **[Open Member Search]**: a search/filter control is added to the
   Member List
4. **[Filter: overdue loans only]**: this is the key business rule for this
   flow, written down here the same way `(stock > 0)` was recorded on the
   Borrowing flow, so it is not forgotten once coding begins.
5. **[View matching members list] -> [Select a member]**: the filtered
   result reuses the same table styling already built in `style.css`
6. **[View that member's overdue titles]**: shows which specific loans are
   overdue for that member, information the librarian needs before
   deciding on next steps
7. **[Back to Dashboard]**: closes the loop, matching the pattern of every
   other flow in this jobsheet.

## Exercise 3 — Additional edge cases

1. **Lending the same book to the same member twice in a row.** If a
   member already has an active (not yet returned) loan for a given title,
   that same title should not be offered again in the "Choose Book" step of
   the Borrowing flow, even if stock remains available. Without this check,
   the same physical copy could appear to be lent out twice at once in the
   records.
2. **A member trying to register with a phone number or email already used
   by an existing member.** Because `members/add.html` collects Phone No.
   and Email (see the jobsheet-01 and jobsheet-02 exercises), duplicate
   contact details could otherwise create two records for what is really
   one person. This should be checked before a new member record is saved.
