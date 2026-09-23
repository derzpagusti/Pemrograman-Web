# wireframe-additions.md

Additional design material for SIMPUS-Mini, produced as the exercises for
Jobsheet 4 (§6.4). These follow the same ASCII wireframe and user-flow
conventions established in `docs/wireframe.md`.

---

## Exercise 1 — Wireframe: "Register New Member" (Guest actor)

```
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
```

**Reading notes** (following the symbol rules in the jobsheet-04
documentation, chapter 2 §2.2):

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

This page is designed for the **Guest** actor (see the jobsheet-04
documentation, chapter 4 §4.2): unlike Login or the Dashboard, no
authorisation is needed to reach it, since anyone should be able to sign up
as a new member.

---

## Exercise 2 — User Flow: "Librarian searches for members with overdue loans"

```
[Librarian Login] -> [Dashboard] -> [Select "Members" menu]
  -> [Open Member Search] -> [Filter: overdue loans only]
  -> [View matching members list] -> [Select a member]
  -> [View that member's overdue titles] -> [Back to Dashboard]
```

Walking through it box by box, following the same style as the Borrowing
and Returning flows in the jobsheet-04 documentation (chapter 3 §3.2–3.3):

1. **[Librarian Login] -> [Dashboard]**: as with every Librarian-only
   feature, the flow starts from a logged-in state (chapter 4 §4.3).
2. **[Select "Members" menu]**: the librarian opens the existing "Members"
   section of the navbar rather than a brand-new menu item.
3. **[Open Member Search]**: a search/filter control is added to the
   Member List page shown in the jobsheet-01 documentation.
4. **[Filter: overdue loans only]**: this is the key business rule for this
   flow, written down here the same way `(stock > 0)` was recorded on the
   Borrowing flow, so it is not forgotten once coding begins.
5. **[View matching members list] -> [Select a member]**: the filtered
   result reuses the same table styling already built in `style.css`
   (jobsheet-02 documentation, chapter 7).
6. **[View that member's overdue titles]**: shows which specific loans are
   overdue for that member, information the librarian needs before
   deciding on next steps (for example, a reminder call).
7. **[Back to Dashboard]**: closes the loop, matching the pattern of every
   other flow in this jobsheet.

---

## Exercise 3 — Additional edge cases

Two more edge cases worth recording alongside the two already listed in
`docs/wireframe.md` (chapter 5 §5.5 of the jobsheet-04 documentation):

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

Recording these now, at the design stage, means the developer already knows
to build these checks in later, rather than discovering the gap only after
the Loan and Register features are coded.
