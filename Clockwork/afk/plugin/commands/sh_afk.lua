--[[
	© 2013 Kuro and all that stuff

--]]

local COMMAND = Clockwork.command:New("afk");
COMMAND.tip = "Toggle Afk Mode";
COMMAND.flags = CMD_DEFAULT;

-- Called when the command has been run.
function COMMAND:OnRun(player)
	player:ConCommand("afk")
end

COMMAND:Register();