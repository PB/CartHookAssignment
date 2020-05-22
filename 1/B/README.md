# CartHookAssignment

## B

### Task
How would you find files that begin with "0aH" and delete them given a folder (with subfolders)? Assume there are many files in the folder.

### Solution
To run: `go run main.go test_dir 0aH`

For safety reason deleting is disabled. You can enable it by uncommenting those lines:
```		//err := os.Remove(path)
   		//if err != nil {
   		//	fmt.Println(err)
   		//}
```
