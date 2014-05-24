--[[
	© 2013 CloudSixteen.com do not share, re-distribute or modify
	without permission of its author (kurozael@gmail.com).
--]]

local COMMAND = Clockwork.command:New("lrc_join");
COMMAND.tip = "Join the long range chat.";


-- Called when the command has been run.
function COMMAND:OnRun(player)
	if (Clockwork.kernel:GetSharedVar("lrc") > 0 or nil) then
		player:SetSharedVar("lrc_join", 1);
		Clockwork.player:Notify(player, "You have joined the long range chat.");
	else
		Clockwork.player:Notify(player, "Long range chat isn't enabled at the moment.");
		player:SetSharedVar("lrc_join", 0)
	end
end;

COMMAND:Register();