-- You might need have Safe Updates unckecked in Preferences > SQL Editior near the bottom
ALTER TABLE user
ADD COLUMN profilepicture BLOB AFTER password;

ALTER TABLE social
ADD COLUMN profilepicture BLOB AFTER comment_date;