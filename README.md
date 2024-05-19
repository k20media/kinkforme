# kinkforme

# --- Rename all files with string belgrade to kinkforme.
# find . -depth -name '*belgrade*' -exec bash -c 'for file; do mv -- "$file" "${file//belgrade/kinkforme}"; done' bash {} +


